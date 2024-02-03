@extends('common.header')
@section('content')

<div class="text-center text-primary m-5">
    <h2>Short URL</h2>
</div>

<div class="text-center">
    @if ($message != "")
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $message }}
      </div>
    @endif
</div>

<div class="text-center border border-2 p-2" id="main_content0">
     <h2>Paste the URL to be shortened</h2><br>

     <form action="{{ url('shorten-url') }}" method="post">
        @csrf

        <div class="row" id="main_content">
            <div class="col-md-10">
              <input type="text" id="main_content1" name="main_url" value="@if($url != "") {{ $url->new_url }} @endif" class="form-control" placeholder="Enter The Link" required>
              @if($url != "")
              <p id="old_url"><strong>Long Url:</strong> <a href="{{ $url->old_url }}" target="_blank">{{ $url->old_url }}</a></p>
              @endif
            </div>
            <div class="col-md-2" >
                @if($url == "")
                   <input type="submit" id="main_content2" class="btn btn-primary" value="Shorten Url">
                @else
                   <input type="button" id="main_content2b" class="btn btn-primary" value="Copy the Url">
                @endif
            </div>
            @if($url == "")
            <div class="col-md-12" id="div01">
                <p id="main_content3">ShortURL is a free tool to shorten URLs and generate short links</p>
            </div>
            @endif
        </div>
    </form>

    <div class="col-md-2" >
        <a href="{{ url('/') }}"><input type="button" id="main_content4" class="btn btn-primary" value="Shorten Another Url"></a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Add this script to handle copying to clipboard -->
<script>
    $(document).ready(function() {
        $('#main_content2b').on('click', function() {
            /* Get the value from the input field */
            var inputValue = $('#main_content1').val();

            /* Create a temporary textarea element */
            var tempTextarea = $('<textarea>');

            /* Set the value of the temporary textarea element to the input field value */
            tempTextarea.val(inputValue).appendTo('body').select();

            /* Copy the selected text to the clipboard */
            document.execCommand('copy');

            /* Optionally, remove the temporary textarea element (if you don't want it to stay in the DOM) */
            tempTextarea.remove();

            /* Optionally, provide some feedback to the user (e.g., alert or message) */
            alert('Copied to clipboard!');
        });
    });
</script>
@endsection