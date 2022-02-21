<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>
    @yield('title')
  </title>
</head>

<body>
  <!-- Nav Bar -->
  <ul class="nav bg-dark">
    <li class="nav-item">
      <a class="nav-link text-light " href="{{route('posts.create')}}">Create Post</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light " href="{{route('posts.index')}}">All Posts</a>
    </li>
  </ul>
    
  @yield('content')

</body>

</html>