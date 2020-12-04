@extends('layouts.site')
@section('content')

<section id="gallary">
    <div class="sticky-header nav-down sticky" id="pics">
       <div class="py-3 px-4 ">
          <div class="row">
             <div class="col-lg-7 col-sm-4 ">
                <div class="t-md-center mb-sm-3  mx-0">
                    <a href="#" onclick="goBack()" class="btn btn-primary btn-sm">
                        <span class="ml-2"> <span class="fa fa-chevron-left"></span> Review selected photos</span>
                    </a>
                </div>
             </div>
             <div class="col-lg-5 col-sm-8">
                <div class="row align-items-center text-right">
                   
                   <div class="col-5 text-right">
                      <p class="ff-sb  fs-14 ls-56 mb-0">
                      <strong> Selected:</strong> <span class="selected-photos"><span class="selected-count">0</span>/<span class="max-photos-count">{{$share->number_of_photo}}</span></span>
                      </p>
                   </div>

                   @if ($share->reviewed == 1)

                   <div class="col-5">
                        <button type="button" class="btn btn-danger rounded-0 text-white"> Submitted</button>
                    </div>
                        
                   @else

                   <div class="col-5">
                        <button type="button" 
                        id="sbBtn" 
                        data-toggle="modal" 
                        data-target="#reviewPopup" 
                        class="btn btn-primary rounded-0 text-white"> 
                        Submit</button>
                    </div>

                   @endif

                </div>
             </div>
          </div>
       </div>
        <hr /> 

       <!-- image gallery -->
       <div class="gallary-images">
          <div class="container-fluid">
             <div class="demo-gallery">
                <div id="lightgallery" class=" masonry-grid">

                </div>
             </div>
          </div>
       </div>
       <!-- image gallary 2 -->
    </div>
 </section>

 <div class="modal fade" id="reviewPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">Write your review to us</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <div class="form-group">

                <textarea name="review" id="review" class="form-control" placeholder="Write your review to us" cols="30" rows="5"></textarea>
                <br>
                <a href="#" id="submitForm" class="btn btn-success btn-sm" >Submit</a>

            </div>

        </div>
        
      </div>
    </div>
  </div>


@endsection



@section('javascript')
<script>
    $(document).ready(function(){

        if (localStorage.getItem("selected_photos") !== null) {

            var photos = JSON.parse(localStorage.getItem("selected_photos"))
            var selected_photos = localStorage.getItem("photo-selected")

            $('.selected-count').text(selected_photos)

           
            var project = localStorage.getItem("project")
            // console.log(project)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({ 
                type: 'POST',
                url: "{{route('get-selected-images')}}",
                data: {photos: photos},
                success: function (data){
                    $.each(data, function(i, item) {

                        let photo = '../../../public/uploads/'+project.toLowerCase()+'/'+item.folder.name.toLowerCase()+'/'+item.photo;

                        let content = '<figure class="item" data-responsive="'+photo+' 375, '+photo+'480,'+photo+'800" data-src="" data-sub-html=" " data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1">'
                            content += '<a href="" class="d-block">'
                            content += '<img class="" width="100%" src="'+photo+'" alt="Thumb-1">'
                            content += '</a>'
                            content += '<div class="heart">'
                            content += '<i class="far fa-heart f-18 heart-fill fas color-red" data-val="" ></i>'
                            content += '</div>'
                            content += '</figure>'

                        $('#lightgallery').append(content)
                    });
                }, 
                error: function(e) {
                    console.log(e)
                }
            })

            $('#submitForm').on('click', function(){

                let client_id = '{{Auth::user()->id}}'
                let review = $('textarea').val();

                $.ajax({ 
                    type: 'POST',
                    url: "{{route('save-review-select-photos')}}",
                    data: {photos: photos, client_id:client_id, review:review },
                    success: function (data){

                            $('#reviewPopup').modal('hide')
                            $('#sbBtn').text('Submitted')
                            $('#sbBtn').removeClass('btn-success')
                            $('#sbBtn').addClass('btn-danger')
                            $('#sbBtn').removeAttr('data-toggle')
                            $('#sbBtn').removeAttr('data-target')

                            Swal.fire(
                            'Good job!',
                            'You review has been submited!',
                            'success'
                            )
                    }, 
                    error: function(e) {
                        console.log(e)
                    }
                })
                })

        }

    })

    const goBack = () => {
        window.history.back();
    } 

</script>    
@endsection