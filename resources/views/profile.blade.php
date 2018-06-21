@extends('layouts.task')


@section('styles')

    <link href="{{ asset('bootstrap_fileUploader/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('bootstrap_fileUploader/themes/explorer-fa/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="error">
                @if($errors->any())
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            @endif
            </div>
            <div class="card">
                <div class="card-header">{{$user}}</div>
                <div class="card-body">
                    <form method="POST" action="{{url('/save')}}" enctype="multipart/form-data">
                    <textarea placeholder="Please Enter Some Notes" cols="210" name="description"></textarea><br><br>
                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <button type="submit" class="btn btn-info"> Save </button>
                    </form> 
                </div>
            </div>

        </div>

        <div class="col-md-12">
            
            {{-- <table class="table">
                <tr>
                  <th>Notes</th>
                  <th>File</th>
                  <th>Action</th>
                </tr>
                @foreach($records as $value)
                <tr>
                  <td>{{ $value->description }}</td><td><a href="{{ asset('uploads/'.$value->file) }}">{{ $value->file }}</a></td><td><a href="{{ url('delete/' . $value->id) }}" class="btn btn-info"> Delete </a></td>
                </tr>
                @endforeach
            </table> --}}


            <div class="chart col-lg-12 col-12">
              <div class="line-chart bg-white d-flex align-items-center justify-content-center has-shadow" style="min-height: 300px; height: auto">

                <form enctype="multipart/form-data" style="width: 90%">
                    <div class="file-loading">
                        <input id="kv-explorer" name="kv-explorer[]" type="file" multiple>
                        <input id="csrf_token" type="hidden" name="_token" value="{{ Session::token() }}">
                    </div>
                    <br>
                    <!-- <div class="file-loading">
                        <input id="file-0a" class="file" type="file" multiple data-min-file-count="1">
                    </div> -->
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </form>

                <!-- <canvas id="lineCahrt"></canvas> -->
              </div>
            </div>

        </div>

    </div>
</div>
@endsection


@section('scripts')

    <script type="text/javascript" src="{{ asset('bootstrap_fileUploader/js/plugins/sortable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bootstrap_fileUploader/js/fileinput.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bootstrap_fileUploader/themes/explorer-fa/theme.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bootstrap_fileUploader/themes/fa/theme.js') }}"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script> -->

    <!-- <script type="text/javascript">
        
        $(document).ready(function()
            {
                console.log("LOL");
            });

    </script> -->

    <script>
      $( function() {
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
      } );
    </script>


    <script type="text/javascript">
        $(document).ready(function () {

            var token = $('#csrf_token').val();

        $("#test-upload").fileinput({
            'theme': 'fa',
            'showPreview': false,
            'allowedFileExtensions': ['jpg', 'png', 'gif'],
            'elErrorContainer': '#errorBlock'
        });


        $("#kv-explorer").fileinput({
            'theme': 'explorer-fa',
            'uploadUrl': '{{ Route("saveImg") }}',
            'uploadExtraData':{'_token':token},
            'allowedFileExtensions': ["jpg", "png", "jpeg"],
            overwriteInitial: false,
            autoReplace: true,
            maxFileSize: 1024,
            maxFileCount: 4,
            initialPreviewAsData: true,
            initialPreview: [
                /*"http://lorempixel.com/1920/1080/nature/1",
                "http://lorempixel.com/1920/1080/nature/2",
                "http://lorempixel.com/1920/1080/nature/3"*/

                @foreach($records as $slide)

                    "{{ asset('uploads/').'/'.$slide->file }}",

                @endforeach()
            ],
            initialPreviewConfig: [
                /*{caption: "nature-1.jpg", size: 329892, width: "120px", url: "{$url}", key: 3},
                {caption: "nature-2.jpg", size: 872378, width: "120px", url: "{$url}", key: 1},
                {caption: "nature-3.jpg", size: 632762, width: "120px", url: "{$url}", key: 2}*/

                @foreach($records as $slide)

                    {caption: "{{ $slide->file }}", width: "120px", url:"{{ route('delImg') }}", key: {{ $slide->id }}, 'extra':{'_token':token}},

                @endforeach()
            ]
        });

        $('#kv-explorer').on('filedeleted', function() {
            console.log("DELETE");
        });




        /*
         $("#test-upload").on('fileloaded', function(event, file, previewId, index) {
         alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);
         });
         */

        $('#kv-explorer').on('fileimageloaded', function(event, previewId) {
            console.log("fileimageloaded");
        });

        $('#kv-explorer').on('filepreajax', function(event, previewId, index) {
            console.log(event);
        });


        $('#kv-explorer').on('filesorted', function(event, params) {
            console.log('File sorted ', params.stack);

            /*var filesCount = $('#kv-explorer').fileinput('getFilesCount');

            console.log(filesCount);*/
        });


        var count = $('#kv-explorer').fileinput('getFileStack');  

        console.log(count);
         
        });
    </script>


@endsection
