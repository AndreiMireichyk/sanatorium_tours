@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-header"> Enter url</div>

                    <div class="card-body">
                        {{request()->get('url')}}
                        <form action="{{route('encode')}}" method="post">
                            @csrf
                            @method('post')
                            <div class="input-group mb-3">
                                <input type="text"
                                       class="form-control @error('url') is-invalid @enderror"
                                       name="url"
                                       value="{{old('url')}}"
                                       placeholder="http://google.com"
                                       aria-describedby="basic-addon2">

                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Cut</button>
                                </div>
                                @error('url')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </form>

                        @if(Session::has('result'))
                            <div class="alert alert-success" role="alert">
                                Your shortened link
                                <input type="text"
                                       class="form-control"
                                       placeholder="{{Session::get('result')}}"
                                       value="{{Session::get('result')}}">
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Last 10 urls</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Full</th>
                                <th scope="col">Short</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($last_urls as $key=>$url)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>
                                        <a href="{{$url->url}}" target="_blank">
                                            {{Str::limit($url->url, 40, '...')}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('decode', $url->hash)}}" target="_blank">
                                            {{route('decode', $url->hash)}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
