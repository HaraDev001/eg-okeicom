@extends('layouts.user-single')

{{--  タイトル・メタディスクリプション  --}}
@section('title', 'レッスン閲覧画面') @section('description', 'レッスン閲覧画面')

{{--  CSS  --}}
@push('css')
{{--  吉田豊が修正しました  --}}
	<style>
        .all-body {
            width:100%;
            margin:auto;
            max-width: 1200px;
        }
        .d_title {
            text-align:center;
        }
        .viewer_pdf {
            width:100%;
            margin:auto;
        }
        .canvas-content {
            margin:auto;
            width: 100%;
            overflow: auto;
            text-align: center;
            border: solid 3px;
        }
        ​
        .prev-button {
            padding: 10px;
            width:100px;
            background: #373B50;
            color: white;
            border-radius: 10px;
        }
        .next-button {
            padding: 10px;
            width:100px;
            background: #373B50;
            color: white;
            border-radius: 10px;
        }
        .control-body {
            text-align:center;
            margin-top:50px;
        }
        .zoom-body {
            text-align:center;
            margin-top:10px;
        }
        .zoom-in {
            padding: 10px;
            width:50px;
            background: #373B50;
            color: white;
            border-radius: 10px;
        }
        .zoom-out {
            padding: 10px;
            width:50px;
            background: #373B50;
            color: white;
            border-radius: 10px;
            margin-left:50px;
        }
        #pdf_renderer {
            width:100%;
        }
        @media(max-width:780px){
            .all-body{
                width:100%;
                margin:auto;
            }
            .viewer_pdf {
                width:100%;
                margin:auto;
            }
            #pdf_renderer {
                width:100%;
            }
            .canvas-content {
                margin:auto;
                width: 100%;
                height: auto;
                overflow: auto;
                text-align: center;
                border: solid 3px;
            }
            .prev-button {
                padding: 10px;
                width:50px;
                background: #373B50;
                color: white;
                border-radius: 10px;
            }
            .next-button {
                padding: 10px;
                width:50px;
                background: #373B50;
                color: white;
                border-radius: 10px;
            }
            .page {
                width:50px;
            }
            .control-body {
                text-align:center;
                margin-top:50px;
            }
            .zoom-body {
                text-align:center;
                margin-top:10px;
                display: none;
            }
            .zoom-in {
                padding: 10px;
                width:50px;
                background: #373B50;
                color: white;
                border-radius: 10px;
            }
            .zoom-out {
                padding: 10px;
                width:50px;
                background: #373B50;
                color: white;
                border-radius: 10px;
                margin-left:50px;
            }
		}
	</style>
@endpush

@section('script')
<script>
    var myState = {
        pdf: null,
        currentPage: 1,
        zoom: 1.4
    }

    pdfjsLib.getDocument("{{ asset('storage/lesson/'. $lesson->view.'/'.$lesson->slide.'.pdf')}}").then((pdf) => {

        myState.pdf = pdf;
        render();

    });

    function render() {
        myState.pdf.getPage(myState.currentPage).then((page) => {

            var canvas = document.getElementById("pdf_renderer");
            var ctx = canvas.getContext('2d');

            var viewport = page.getViewport(myState.zoom);

            canvas.width = viewport.width;
            canvas.height = viewport.height;

            page.render({
                canvasContext: ctx,
                viewport: viewport
            });
        });
    }

    document.getElementById('go_previous').addEventListener('click', (e) => {
        prev_event();
    });

    function prev_event() {
        if (myState.pdf == null || myState.currentPage == 1)
            return;
        myState.currentPage -= 1;
        document.getElementById("current_page").value = myState.currentPage;
        render();
    }

    document.getElementById('go_next').addEventListener('click', (e) => {
        next_event();
    });

    function next_event() {

        if (myState.pdf == null || myState.currentPage == myState.pdf._pdfInfo.numPages) {

        } else {
            myState.currentPage += 1;
            document.getElementById("current_page").value = myState.currentPage;
            render();
        }
    }

    document.addEventListener('keydown', (e) => {

        var code = (e.keyCode ? e.keyCode : e.which);
        console.log(code)
        if (code == 37) {
            prev_event();
        }
        if (code == 39) {
            next_event();
        }
        if (code == 38) {
            zoom_in();
        }
        if (code == 40) {
            zoom_out();
        }
    });

    document.getElementById('current_page').addEventListener('keypress', (e) => {
        if (myState.pdf == null) return;

        // Get key code
        var code = (e.keyCode ? e.keyCode : e.which);
        console.log(code)
            // If key code matches that of the Enter key
        if (code == 13) {
            var desiredPage =
                document.getElementById('current_page').valueAsNumber;

            if (desiredPage >= 1 && desiredPage <= myState.pdf._pdfInfo.numPages) {
                myState.currentPage = desiredPage;
                document.getElementById("current_page").value = desiredPage;
                render();
            }
        }

    });

    document.getElementById('zoom_in').addEventListener('click', (e) => {
        zoom_in();
    });

    document.getElementById('zoom_out').addEventListener('click', (e) => {
        zoom_out();
    });
​
    function zoom_out(){
        if(myState.pdf == null) return;
        myState.zoom -= 0.5;
        render();
    }
    </script>
@endsection


<!-- 本文 -->
@section('content')
<!-- 吉田豊が修正しました -->

<div class="l-wrap l-flex">
    <div class="l-wrap--title">
        <h1 class="c-headline--screen">レッスン受講画面</h1>
    </div>
    <div style="width:100%; height:80vh;">
        <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ asset('storage/lesson/'.$lesson->view.'/'.$lesson->slide)}}" width='100%' height='100%' frameborder='0'></iframe>
    </div>
    {{--  @if($lesson->type !== 2)
    <div class="l-wrap--body">
        <div class="l-wrap--main l-wrap--detail">
            <div class="l-content--detail">
                <div class="l-content--detail__inner">
                    <div class="browsing-url">
                        <a class="u-text--link" target="_blank" rel="noopener noreferrer" href="https://www.youtube.com/watch?v=rOho8r3Y2_k">https://www.youtube.com/watch?v=rOho8r3Y2_k</a>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
    {{--  @else
    <div id="my_pdf_viewer">
        <div id="canvas_container" class="canvas-content">
            <canvas id="pdf_renderer"></canvas>
        </div>

        <div id="navigation_controls" class="control-body">
            <button class="prev-button" id="go_previous" type="button">前へ</button>
            <input id="current_page" value="1" type="number" class="page" />
            <button class="next-button" id="go_next" type="button">次へ</button>

        </div>

        <!-- <div id="zoom_controls" class="zoom-body">
				<button id="zoom_in" class="zoom-in">+</button>
				<button id="zoom_out" class="zoom-out">-</button>
			</div> -->
    </div>
    <!-- 吉田豊が修正しました -->
    @endif  --}}
</div>
@endsection
