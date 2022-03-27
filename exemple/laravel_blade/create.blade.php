<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ready</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.min.css" integrity="sha512-T584yQ/tdRR5QwOpfvDfVQUidzfgc2339Lc8uBDtcp/wYu80d7jwBgAxbyMh0a9YM9F8N3tdErpFI8iaGx6x5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body class="bg-white">

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                    <form action="{{route('post.create')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Description</label>
                            <textarea name="description" rows="4" class="form-control @error('title') is-invalid @enderror">{{old('description')}}</textarea>
                        </div>
                        <div class="mt-3">
                            <label for="" class="m-0">Media</label>
                            <div id="app">
                                <upload-media 
                                    server='/api/upload'
                                    error="@error('media'){{$message}}@enderror">
                                </upload-media>

                            </div>
                            
                        </div>
                        <button class="btn btn-primary text-white mt-4">Submit</button>
                    </form>
                </div>  
            </div>
        </div>
    </div>

    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>
