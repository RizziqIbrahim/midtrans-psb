<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Donasi</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Donasi</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <div class="justify-content-center align-items center">
        <div class="container mt-5">
            <div class="card">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>nama</th>
                        <th>Jenis Pembayaran</th>
                        <th>Email</th>
                        <th>No telp</th>
                        <th>Nominal</th>
                      </tr>
                        
                    </thead>
                    <tbody>
                        @foreach($order as $item)
                        <tr>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->category->nama_category}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->nomor}}</td>
                            <td>{{$item->jumlah}}</td>
                       
                        </tr>
                        @if(!$item->isPaid()) 
                          <a href="{{$item->payment_url}}" class="btn btn-primary mt-5 mb-5">Bayar</a>
                        @endif
                        @endforeach
                        
                    </tbody>
                </table>
                
                
            </div>
        </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>