<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>HMS Log Viewer | {{getAppName()}}</title>
    <meta name="description" content="Hospital management system">
    <meta name="keyword" content="hospital,doctor,patient,fever,MD,MS,MBBS">
    <link rel="canonical" href="{{ route('landing.home') }}"/>
    <link rel="stylesheet" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <link href="{{ mix('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/logs.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
</head>
<body>
<?php
$style = 'style=';
$paddingBottom = 'padding-bottom:';
$marginTop = 'margin-top:';
$display = 'display:';
$whiteSpace = 'pre-wrap:';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col sidebar mb-3">
            <h1><i class="fa fa-calendar" aria-hidden="true"></i> Laravel Log Viewer</h1>
            <p class="text-muted"><i>by Rap2h</i></p>


            <div class="custom-control custom-switch" {{$style}}"{{$paddingBottom}}20px;">
            <input type="checkbox" class="custom-control-input" id="darkSwitch">
            <label class="custom-control-label" for="darkSwitch" {{$style}}"{{$marginTop}} 6px;">Dark Mode</label>
        </div>

        <div class="list-group div-scroll">
            @foreach($folders as $folder)
                <div class="list-group-item">
                    <a href="?f={{ \Illuminate\Support\Facades\Crypt::encrypt($folder) }}">
                        <span class="fa fa-folder"></span> {{$folder}}
                    </a>
                    @if ($current_folder == $folder)
                        <div class="list-group folder">
                                @foreach($folder_files as $file)
                                    <a href="?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}&f={{ \Illuminate\Support\Facades\Crypt::encrypt($folder) }}"
                                       class="list-group-item @if ($current_file == $file) llv-active @endif">
                                        {{$file}}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
                @foreach($files as $file)
                    <a href="?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}"
                       class="list-group-item @if ($current_file == $file) llv-active @endif">
                        {{$file}}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-10 table-container">
            @if ($logs === null)
                <div>
                    Log file >50M, please download it.
                </div>
            @else
                <table id="table-log" class="table table-striped" data-ordering-index="{{ $standardFormat ? 2 : 0 }}">
                    <thead>
                    <tr>
                        @if ($standardFormat)
                            <th>Level</th>
                            <th>Context</th>
                            <th>Date</th>
                        @else
                            <th>Line number</th>
                        @endif
                        <th>Content</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($logs as $key => $log)
                        <tr data-display="stack{{{$key}}}">
                            @if ($standardFormat)
                                <td class="nowrap text-{{{$log['level_class']}}}">
                                    <span class="fa fa-{{{$log['level_img']}}}"
                                          aria-hidden="true"></span>&nbsp;&nbsp;{{$log['level']}}
                                </td>
                                <td class="text">{{$log['context']}}</td>
                            @endif
                            <td class="date">{{{$log['date']}}}</td>
                            <td class="text">
                                @if ($log['stack'])
                                    <button type="button"
                                            class="float-right expand btn btn-outline-dark btn-sm mb-2 ml-2"
                                            data-display="stack{{{$key}}}">
                                        <span class="fa fa-search"></span>
                                    </button>
                                @endif
                                {{{$log['text']}}}
                                @if (isset($log['in_file']))
                                    <br/>{{{$log['in_file']}}}
                                @endif
                                @if ($log['stack'])
                                    <div class="stack" id="stack{{{$key}}}"
                                    {{$style}}"{{$display}} none; {{$whiteSpace}} pre-wrap;">{{{ trim($log['stack']) }}}
        </div>
    @endif
    </td>
    </tr>
    @endforeach

    </tbody>
    </table>
    @endif
    <div class="p-3">
                @if($current_file)
                    <a href="?dl={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                        <span class="fa fa-download"></span> Download file
                    </a>
                    -
                    <a id="clean-log"
                       href="?clean={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                        <span class="fa fa-sync"></span> Clean file
                    </a>
                    -
                    <a id="delete-log"
                       href="?del={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                        <span class="fa fa-trash"></span> Delete file
                    </a>
                    @if(count($files) > 1)
                        -
                        <a id="delete-all-log"
                           href="?delall=true{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                            <span class="fa fa-trash-alt"></span> Delete all files
                        </a>
                    @endif
        @endif
    </div>
</div>
</div>
</div>
<!-- jQuery for Bootstrap -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<!-- FontAwesome -->
<script defer src="{{ asset('assets/js/all.js') }}"></script>
<!-- Datatables -->
<script type="text/javascript" src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>


<script type="text/javascript" src="{{ asset('assets/js/logs/logs.js') }}"></script>
</body>
</html>
