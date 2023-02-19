<div align="center">

  <a href="https://www.npmjs.com/package/vue-media-upload" target="_blank">
    <img alt="npm" src="https://img.shields.io/npm/v/vue-media-upload.svg?style=flat">
  </a>
  <a href="https://www.npmjs.com/package/vue-media-upload" target="_blank">
    <img alt="npm" src="https://img.shields.io/npm/dm/vue-media-upload.svg?style=flat">
  </a>
  <a href="https://www.npmjs.com/package/vue-media-upload" target="_blank">
    <img alt="npm" src="https://img.shields.io/npm/l/vue-media-upload.svg?style=flat">
  </a>
  <a href="https://www.npmjs.com/package/vue-media-upload" target="_blank">
    <img alt="npm" src="https://img.shields.io/bundlephobia/minzip/vue-media-upload">
  </a>

  # vue-media-upload

</div>
<div align="">

  📷 **vue-media-upload** is a Vuejs package that handle multiple images upload and preview.

  🖼️ **This package** support **the create and the update form**, and handles the upload for you.

  ![vue-media-upload - multiple image upload with preview ](/static/vue-media-upload.jpg)
  
</div>


# 👀 Demo

- [Full featured demo](https://github.com/saimow/media-upload-demo)


# 💻 Install

via npm
```sh
npm install vue-media-upload
```

or via yarn 
```sh
yarn add vue-media-upload
```


# 🕹 Usage

```javascript
import { createApp } from 'vue';

import Uploader from 'vue-media-upload';

let app = createApp({})

app.component('Uploader', Uploader);

app.mount("#app")
```

or

```javascript
import Uploader from "vue-media-upload";

export default {
  components: {
    Uploader
  }
};
```

# 🔎 Example

## Create Form

```vue
<template>
  <div>
    <Uploader
      server="/api/upload"
      @change="changeMedia"
    />
  </div>
</template>

<script>
  import Uploader from 'vue-media-upload'

  export default {
    data() {
      return {
        media: []
      }
    },
    methods:{
      changeMedia(media){
        this.media = media
      }
    },
    components: {
      Uploader
    },
  }
</script>
```

## Update Form

```vue
<template>
  <div>
    <Uploader
      server="/api/upload"
      :media="media.saved"
      path="/storage/media"
      @add="addMedia"
      @remove="removeMedia"
    />
  </div>
</template>

<script>
  import Uploader from 'vue-media-upload'

  export default {
    data() {
      return {
        media: {
          saved: [
            { id: 1, name: '123_image.jpg' },
            { id: 2, name: '456_image.jpg' },
          ],
          added: [],
          removed: []
        }
      }
    },
    methods:{
      addMedia(addedImage, addedMedia){
        this.media.added = addedMedia
      },
      removeMedia(removedImage, removedMedia){
        this.media.removed = removedMedia
      }
    },
    components: {
      Uploader
    },
  }
</script>
```


# ⚙️ Props

| Prop | Type | Default | Description |
| --- | --- | :---: | --- |
| **server** | String | `'/api/upload'` | The Route that handle the image upload. The Upload handler should return the name of the uploaded image in the following format: <br> `{ "name": "123_image.jpg" }` |
| **isInvalid** | Boolean | `false` | Whether error styling should be applied. |
| **media** | Array | `[]` | The list of the stored images, that each of which must have the property `name` containing the name of the image. <br> `[ { name: '123_image.jpg' } , { name: '456_image.jpg' } ]` |
| **location** | String | `''` | The location of the folder where the saved images are stored.|
| **max** | Number | `null` | The maximum number of files allowed to be uploaded.|
| **maxFilesize** | Number | `4` | The maximum filesize (in megabytes) that is allowed to be uploaded|
| **warnings** | Boolean | `true` | By default, the package uses JavaScript alerts to display warnings. In case you want to use your custom warnings, you can disable the component pop-ups using this prop. |


# 💾 Events

| Event | Payload | Description |
| --- | --- | --- |
| **@init** | `param` : The list of all the listed images. | Emitted when the component is ready to use. |
| **@change** | `param` : The list of all the listed images. | Emitted after an image was added or removed. |
| **@add** | `param1` : The image that was added. <br> `param2` : The list of the added Images. | Emitted after an image was added. |
| **@remove** | `param1` : The image that was removed. <br> `param2` : The list of images that have been removed from the stored media. | Emitted after an image was removed. |
| **@max** | | Emitted when `max` prop is exceeded. |
| **@max-filesize** | `param` : The image size. | Emitted when `maxFilesize` prop is exceeded. |


# 📙 How it works in a Server-Rendered Form?

1. **vue-media-upload** component uploads the image `image.jpg` as multipart/form-data using a POST request.

2. **server** temporary saves the image with a unique name `123_image.jpg` in a `/tmp/uploads` folder.

3. **server** returns the unique name `123_image.jpg` in a request response.

4. **vue-media-upload** insert the unique name `123_image.jpg` in a hidden html input with `name="added_media[]"`.

5. **user** submits the component parent form, which includes the hidden input field containing the unique image name.

6. **server** uses the unique image name to move `123_image.jpg` from the `/tmp/uploads` folder to its final location.


# 🔣 Inputs

> **Note** that all this inputs are **hidden** and they are just a way to validate and pass data to the backend when using this package in a **Server-Rendered Form**!

| Name attribute | Description |
| --- | --- |
| **added_media[]**  | The added images in the component |
| **removed_media[]**  | The images that have been removed from the stored media. |
| **media**  | This input is added, when the component has at least one image or more listed, as a way for the backend to validate the Images as being required. |


# 🤝 Contributing

1. Fork this repository.
2. Create new branch with feature name.
3. Create your feature.
4. Commit and set commit message with feature name.
5. Push your code to your fork repository.
6. Create pull request. 🙂


# ⭐️ Support

If you like this project, You can support me with starring ⭐ this repository.

![vue-media-upload - multiple image upload with preview ](/static/vue-media-upload.jpg)


# 📄 License

[MIT](LICENSE)

Developed with ❤️