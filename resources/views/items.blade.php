<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Shopping List</title>
</head>

<body>
  <div class="row justify-content-center mt-5">
    <div class="col-lg-6">
      @if(session()->has('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}
      </div>
      @endif

      @if ($errors->any())
      @foreach ($errors->all() as $error)
      <div class="alert alert-danger">
        {{$error}}
      </div>
      @endforeach
      @endif
    </div>
  </div>

  <div class="text-center mt-5">
    <h2>Add Items</h2>

    <form class="row g-3 justify-content-center" method="POST" action="{{route('items.store')}}">
      @csrf
      <div class="col-7">
        <input type="text" class="form-control" name="item" placeholder="Item">
      </div>
      <div class="col-2">
        <input type="text" class="form-control" name="nos" placeholder="Nos">
      </div>
      <div class="col-1">
        <button type="submit" class="btn btn-primary mb-3">Submit</button>
      </div>
    </form>
  </div>

  <div class="text-center">
    <h2>All Items</h2>
    <div class="row justiy-content-center">
      <div class="col-lg-6">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">SR</th>
              <th scope="col">Name</th>
              <th scope="col">Nos</th>
              <th scope="col">Purchased</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @php $counter=1 @endphp

            @foreach($items as $item)
            <tr>
              <th>{{$counter}}</th>
              <td>{{$item->item}}</td>
              <td>{{$item->nos}}</td>
              <td>
                @if($item->is_purchased)
                <div class="badge bg-success">Purchased</div>
                @else
                <div class="badge bg-warning">Not Purchased</div>
                @endif
              </td>
              <td>
                <a href="{{route('items.edit',['item'=>$item->id])}}" class="btn btn-outline-primary">Edit</a>
                <a href="{{route('items.destroy',['item'=>$item->id])}}" class="btn btn-outline-danger">Delete</a>
              </td>
            </tr>
            @php $counter++; @endphp
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</body>

</html>