@extends('backend.layout.master')

@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="card">
                <h5 class="card-header">
                    Posts
                    <a href="{{route('post.create')}}" class="btn btn-success float-right"><i class="fas fa-plus-circle"></i> Add Post</a>
                </h5>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>SubTitle</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $index=>$post)
                                <tr>
                                    <td>{{$index++}}</td>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->sub_title}}</td>
                                    <td>
                                        <a href="#" class="delete" id="{{$post->id}}"><i class="fa fa-trash"></i></a>|
                                        <a href="{{route('post.edit',['post'=>$post->id])}}"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
              </div>

        </div>
        <!-- /.container-fluid -->
@endsection
