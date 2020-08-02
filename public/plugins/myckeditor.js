
        if($('#pertanyaan').length)
        {
              CKEDITOR.replace('pertanyaan', {
                    filebrowserUploadUrl: "{{route('image.upload', ['_token' => csrf_token()])}}",
                    filebrowserUploadMethod: 'form',
                    height: 100
              });
        }
        if($('#pilihan1').length)
        {
              CKEDITOR.replace('pilihan1', {
                    filebrowserUploadUrl: "{{route('image.upload', ['_token' => csrf_token()])}}",
                    filebrowserUploadMethod: 'form',
                    height: 100
              });
        }
        if($('#pilihan2').length)
        {
              CKEDITOR.replace('pilihan2', {
                    filebrowserUploadUrl: "{{route('image.upload', ['_token' => csrf_token()])}}",
                    filebrowserUploadMethod: 'form',
                    height: 100
              });
        }
        if($('#pilihan3').length)
        {
              CKEDITOR.replace('pilihan3', {
                    filebrowserUploadUrl: "{{route('image.upload', ['_token' => csrf_token()])}}",
                    filebrowserUploadMethod: 'form',
                    height: 100
              });
        }
        if($('#pilihan4').length)
        {
              CKEDITOR.replace('pilihan4', {
                    filebrowserUploadUrl: "{{route('image.upload', ['_token' => csrf_token()])}}",
                    filebrowserUploadMethod: 'form',
                    height: 100
              });
        }