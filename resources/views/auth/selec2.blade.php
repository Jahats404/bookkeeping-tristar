<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select2 dengan Spasi</title>
    <!-- Include CSS Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
    <div class="form-group">
        <label for="kp_id" class="col-form-label">Fitur</label>
        <select class="form-control js-example-tokenizer" style="width: 100%; height: 300px;" multiple="multiple" name="fitur[]">
        </select>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include JS Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $(".js-example-tokenizer").select2({
                tags: true,                 // Mengizinkan input custom
                allowClear: true,           // Mengizinkan penghapusan semua pilihan
                placeholder: "Fitur Paket", // Placeholder untuk dropdown
                createTag: function(params) {
                    var term = $.trim(params.term); // Menghapus spasi ekstra
                    if (term === '') {
                        return null; // Jangan tambahkan tag jika input kosong
                    }
                    return {
                        id: term,
                        text: term,
                        newTag: true // Tandai bahwa ini adalah tag baru
                    };
                },
                tokenSeparators: [] // Menghapus pemisah token, memungkinkan input spasi
            });
        });
    </script>
</body>
</html>
