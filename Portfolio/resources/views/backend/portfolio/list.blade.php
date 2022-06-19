@extends('layouts.admin_layout')

@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">List of services</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            
        </ol>
        
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Serial</th>
                <th scope="col">Title</th>
                <th scope="col">Sub Title</th>
                <th scope="col">Big Image</th>
                <th scope="col">Small Image</th>
                <th scope="col">Description</th>
                <th scope="col">Client</th>
                <th scope="col">Cetagory</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @if (count($portfolio)>0)

                    @foreach ($portfolio as $portfolios)
                        <tr>
                            <th scope="row">{{$portfolios->id}}</th>
                            <td>{{$portfolios->title}}</td>
                            <td>{{$portfolios->sub_title}}</td>
                            <td>
                                <img style="height: 5vh" src="{{url($portfolios->big_image)}}" alt="big_image">
                            </td>
                            <td>
                                <img style="height: 5vh" src="{{url($portfolios->small_image)}}" alt="small_image">
                            </td>
                            <td>{{Str::limit(strip_tags($portfolios->description),40)}}</td>
                            <td>{{$portfolios->client}}</td>
                            <td>{{$portfolios->category}}</td>
                            <td>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <a href="{{route('admin.portfolios.edit' , $portfolios->id)}}" type="button" class="btn btn-primary mx-4 ">Edit</a>
                                    </div>
                                    <div class="col-sm-2">
                                        <form action="{{route('admin.portfolios.destroy', $portfolios->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" name="submit" value="Delete" class="btn btn-danger mx-4">
                                        
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    
                @endif
            </tbody>
          </table>
    
</main>
@endsection


