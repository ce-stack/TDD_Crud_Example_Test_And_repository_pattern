<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>





    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="page-header">
                    <h2>All posts</h2>
                </div>
                @foreach($posts as $post)
                <div class="card">
                    <div class="card-body">
                        {{$post->description}}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>


</head>
<body>

</body>
</html>
