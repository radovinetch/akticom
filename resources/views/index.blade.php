<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Form</title>
</head>
<body>
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
    @endif
    <form action="{{url('/result')}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="mb-3">
            <label for="fileInput" class="form-label">Загрузите файл</label>
            <input type="file" class="form-control" id="fileInput" name="file">
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>
</body>
</html>
