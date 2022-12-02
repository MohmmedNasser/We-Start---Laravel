<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">


        <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    </head>
    <body>

        <div class="page-wrapper">
            <div class="container">
                <div class="upload-wrapper">

                    <div class="box">

                        <h1>
                            Upload Video with progress bar
                        </h1>

{{--                        <form id="form" method="post" action="{{ route('upload-video') }}" enctype="multipart/form-data">--}}
                        <form id="form">
                            @csrf
                            <div class="custom-file-upload">
                                <input type="file" name="myvideo" accept=".MP4, .MOV, .WMV, .FLV, .MKV" id="file">
                                <span class='button'>Choose</span>
                                <label class='label' data-js-label>No file selected</label>
                            </div>
                            <button type="submit" class="upload-btn">Upload</button>
                        </form>

                        <div class="progress-box">
                            <label for="progress-bar">0%</label>
                            <progress id="progress-bar" value="0" max="100"></progress>
                        </div>

                    </div>

                </div>
            </div>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.min.js"></script>
        <script>
            const form = document.getElementById('form');
            const bar = document.getElementById('progress-bar');
            const barBox = document.querySelector('.progress-box');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData();
                const file = document.getElementById('file');
                const video = file.files[0];
                formData.append('myvideo', video);
                const config = {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    },
                    onUploadProgress: function(progressEvent) {
                        barBox.classList.add('show');
                        const percentCompleted = Math.round((progressEvent.loaded / progressEvent.total)*100);
                        bar.setAttribute('value', percentCompleted);
                        bar.previousElementSibling.textContent = `${percentCompleted}%`;
                        if (percentCompleted === 100) {
                            bar.previousElementSibling.textContent = `Upload complete!`
                        }
                    }
                }

                if(file.files[0]) {
                    axios.post('{{ url('upload-video') }}', formData, config)
                        .then(res => console.log(res))
                        .catch(err => console.log(err))
                }
            })

        </script>
    </body>
</html>
