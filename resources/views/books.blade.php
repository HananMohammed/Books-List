@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-primary">
                        <a href="{{route('home')}}" class="btn btn-warning text-dark ml-3">Add new book</a>
                        <a href="{{route('books.create')}}" class="btn btn-info text-light ml-3"> Sort Book Lists</a>
                        <div class="search">
                            <form action="{{route('search')}}" mathod="get">
                                <div class="input-group">
                                  <input type="text" placeholder="search" class="form-control col-lg-8"name="search">
                                  <button type="submit" class="btn btn-primary col-lg-2 ml-2 input-group-prepend ">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                             <div class=" justify-content-center row">
                                    @foreach($data as $book)
                             <div class="card col-lg-3 mx-3" style="width: 18rem;padding:10px 10px 10px 10px ;margin-top:15px"  >
                                    <div class="card-body">
                                        <img class="card-img-top" src="{{asset_public('images').'/'.$book->file}}" style="height:107px;" >
                                        <ul class="list-group list-group-flush">
                                         <li class="list-group-item"><label class="text-primary">Book title : </label>{{$book->title}} </li>
                                         <li class="list-group-item"> <label class="text-primary">Sub title : </label>{{$book->subtitle}} </li>
                                         <li class="list-group-item"><label class="text-primary">Author :</label> {{$book->author}} </li>
                                         <li class="list-group-item  hidden-li"><label class="text-primary">Published at :</label> {{$book->published_at}}  </li>
                                         <li class="list-group-item  hidden-li"><label class="text-primary">Publisher :  </label> {{$book->publisher}}</li>
                                         <li class="list-group-item  hidden-li"><label class="text-primary">Number of book pages : </label>{{$book->pages}}  </li>
                                        <li class="list-group-item  hidden-li"><label class="text-primary">Book Website : </label>{{$book->website}}  </li>
                                        <li class="hidden-li"><p class="card-text "><label class="text-primary">Book description : </label> {{$book->description}} </p></li>
                                         </ul>
                                        <div  style="margin-top:10px;" >
                                            <a  type="submit" class=" btn btn-info text-light show-li " style="float:left;margin-right:3px"> More details</a>
                                            <form method="post" action="{{route('books.destroy',[$book->id])}}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger ">delete</button>
                                            </form>
                                        </div>
                                    </div>
                             </div>
                                 @endforeach

                                </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function () {
        $(".show-li").on('click',function () {
             $(this).parent().parent().children().children().slideDown(1000) ;
             $(this).removeClass('show-li').text('less details').addClass('less');
              $(this).click(function () {
                  $('.hidden-li').css('display','none')
               })
        })

    })
</script>
@endsection
