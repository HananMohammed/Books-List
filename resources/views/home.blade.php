@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-primary"> create your own list
                    <a href="{{route('books.index')}}" class="btn btn-info text-light ml-3"> your Book Lists</a>
                    <div class="search">
                        <form  mathod="get">
                            <div class="input-group">
                                <input type="text" id = "input-search" placeholder="search" class="form-control col-lg-8"name="search by specific topic">
                                <button type="submit" id = "btn-search"class="btn btn-primary col-lg-2 ml-2 input-group-prepend">Search</button>
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
                        <h5 class="text-primary"> choose your favourite way to Show Book list </h5>
                        <div class="form-check  mt-3">
                            <div class=" mx-5 check-group disappear">
                                <input class="form-check-input position-static" id="check1" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
                                <label> remotely Book list..... </label>
                                <div class="form1" >
                                    <form class="form-group">
                                        <input type="url"  name ="url" id="jsonurl" class="form-control" placeholder="Enter the URL of the list " required >
{{--                                        <a href="{{route('remote-books')}}"  type="submit" id="btn1" class="btn btn-primary ml-5 mt-3"></a>--}}
                                         <input type="submit" id="btn1" class="btn btn-primary ml-5 mt-3">
                                    </form>
                                </div>
                            </div>
                          <div  class=" mx-5 check-group disappear">
                              <input class="form-check-input position-static" id="check2" type="radio" id="blankCheckbox" value="option1" aria-label="...">
                              <label>create your own list.... </label>
                              <div class="form2">
                                  <form class="form-group "method="post" action="{{route('books.store')}}" method="post" enctype="multipart/form-data">
                                     @csrf
                                      <input type="text"  class="form-control mt-3" name="title"  value="{{old('title')}}"  placeholder="Enter book title">
                                     @error('title')<label class="text-danger" role="alert">{{$message}}</label> @enderror
                                      <input type="text"  class="form-control mt-3" name="subtitle"  value="{{old('subtitle')}}" placeholder="Enter book sub title">
                                      @error('subtitle')<label class="text-danger" role="alert">{{$message}}</label> @enderror
                                      <input type="text"  class="form-control mt-3" name="author"  value="{{old('author')}}"  placeholder="Enter book author">
                                      @error('author')<label class="text-danger" role="alert">{{$message}}</label> @enderror
                                      <input type="date"  class="form-control mt-3" name="published_at" value="{{old('published_at')}}">
                                      @error('published_at')<label class="text-danger" role="alert">{{$message}}</label> @enderror
                                      <input type="text"  class="form-control mt-3" name="publisher"   value="{{old('publisher')}}" placeholder="Enter book Publisher">
                                      @error('publisher')<label class="text-danger" role="alert">{{$message}}</label> @enderror
                                      <input type="number"  class="form-control mt-3" name="pages"   value="{{old('pages')}}" placeholder="Enter pages number ">
                                      @error('pages')<label class="text-danger" role="alert">{{$message}}</label> @enderror
                                      <textarea  class="form-control mt-3 " rows="4" name="description"  value="{{old('description')}}" placeholder=" Enter the description "></textarea>
                                      @error('description')<label class="text-danger" role="alert">{{$message}}</label> @enderror
                                      <input type="url" class="form-control mt-3" name="website" value="{{old('website')}}" placeholder="Enter book website link">
                                      @error('website')<label class="text-danger" role="alert">{{$message}}</label> @enderror
                                       <input type="file" class="form-control mt-3" name="file" >
                                      @error('file')<label class="text-danger" role="alert">{{$message}}</label> @enderror

                                      <input type="submit" class="btn btn-primary ml-5 mt-3">

                                  </form>
                              </div>
                          </div>
                        </div>

                        <div class=" mx-5 check-group justify-content-center row " id="remote-books" ></div>

                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function () {

              $("#check1").on("click",function () {
                  $(this).attr("checked","true")
                  $(".form1").css("display","block")
                  $("#check2").removeClass("checked")
                  $(".form2").css("display","none")
            })
              $("#check2").on("click",function () {
                $("#check1").removeClass("checked")
                $(".form1").css("display","none")
                $(".form2").css("display","block")
                $(this).attr("checked","true")
            })
              $("#btn1").on('click',function (e) {
                 e.preventDefault();
                 e.stopPropagation();
                 var url = $("#jsonurl").val();
                // console.log(url)
                      $.ajax({
                          'url':url,
                          'method':'get',
                          cache:false,
                          'enctype': 'multipart/form-data',
                          'contentType': false,
                           success :function (response) {
                               {{--window.location.href = "{{ route('remote-books')}}";--}}
                               var obj = JSON.parse(response);
                               var i
                               //console.log(obj)
                               for (i=0;i<=obj.length;i++){
                                   console.log(obj[i].title)
                                   $('.disappear').css('display','none')
                                   var source = "{{ URL::asset('public/images/book.jpg')}}";
                                   $('.img-status').attr('src', source);
                                   $('#remote-books').append(
                                       '<div class="card col-lg-3" style="width: 18rem;margin-right:2%;margin-top:15px"  id="remote">'+
                                       '<img class="card-img-top" style="height:107px;"src='+source+'>'+
                                       ' <div class="card-body">'+
                                       ' <ul class="list-group list-group-flush">'+
                                       ' <li class="list-group-item"><label class="text-primary">Book title : </label>'+obj[i].title+'</li>'+
                                       ' <li class="list-group-item"> <label class="text-primary">Sub title : </label>'+obj[i].subtitle+'</li>'+
                                       ' <li class="list-group-item"><label class="text-primary">Author : </label>'+obj[i].author+'</li>'+
                                       ' <li class="list-group-item  hidden-li"><label class="text-primary">Published at : </label>'+obj[i].published+'</li>'+
                                       ' <li class="list-group-item  hidden-li"><label class="text-primary">Publisher : </label>'+obj[i].publisher+'</li>'+
                                       ' <li class="list-group-item  hidden-li"><label class="text-primary">Number of book pages : </label>'+obj[i].pages+'</li>'+
                                       ' <li class="list-group-item  hidden-li"><label class="text-primary">Book Website : </label>'+obj[i].website+'</li>'+
                                       '<li class="hidden-li"><p class="card-text "><label class="text-primary">Book description : </label>'+obj[i].description+'</p></li>'+
                                       ' </ul>'+
                                       '<a class="btn btn-info text-light show-li mt-3" style="font-weight: bold ;float:left;margin-left: -25px"> More details</a>'+
                                       '<a class="btn btn-danger text-light mt-3 delete" style="font-weight: bold ;float:right;"> delete</a>'+
                                       '</div>'
                                   )
                                   $(".show-li").on('click',function () {
                                       $(this).parent().children().children().slideDown(1000) ;
                                       $(this).removeClass('show-li').text('less details').addClass('less');
                                       $(this).click(function () {
                                           $('.hidden-li').css('display','none')
                                       })
                                   })
                                   $(".delete").on('click',function () {
                                       $(this).parent().parent().hide();
                                   })
                                   $("#btn-search").on("click",function (e) {
                                       e.preventDefault()
                                       e.stopPropagation()
                                       var value = $("#input-search").val().toLowerCase();
                                           $("#remote-books *").filter(function() {
                                           $(this).toggle($(this).parent().html().toLowerCase().indexOf(value) > -1)
                                               $("div #remote").addClass('col-lg-8 justify-content-center')
                                           $("#remote-books").children().removeClass('col-lg-3')
                                            $(('.col-lg-3')).hide()
                                       });
                                   })
                               }
                           }
                      })
               })

        })

    </script>
@endsection
