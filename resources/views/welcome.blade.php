<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>To Scripe</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="container">
                    <div class="row justify-content-center align-items-center pt-5 pb-5">
                        {{-- @foreach ($data as $d)                        
                            <div class="col-6 mb-2">
                                <div class="card">
                                    <div class="card-header">
                                    By : {{ explode(';',$d)[1] }}
                                    </div>
                                    <div class="card-body">
                                    <h5 class="card-title">{{ explode(';',$d)[2] }}</h5>
                                    <p class="card-text">{{ explode(';',$d)[0] }}</p>
                                    
                                    </div>
                                </div>
                            </div>
                        @endforeach --}}

                        <div class="jumbotron shadow-sm w-100" style="background-color: #f1faee">
                            <h1 class="display-4">{{ $quote->author }}</h1>
                            <p class="lead">{{ $quote->quote }}</p>
                            <hr class="my-4">
                            <p>{{ rtrim($quote->tags,',') }}</p>
                            <a class="btn btn-warning text-white" href="{{ route('index') }}" role="button">Shuffle</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</html>
