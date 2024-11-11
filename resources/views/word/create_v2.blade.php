<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function() {
        $('#creste').click(function() {
            $.ajax({
                type: "POST", 
                url: "word/create", 
                data: {
                    "_token": "{{ csrf_token() }}", 
                    word: $("input[name='word']").val(), 
                    detail: $("input[name='detail']").val(), 
                    body: $("input[name='body']").val()
                }, 
            })

            .done(function(res)) {
                console.log(res)
            }

            .fail(function(jqXHR, textStatus, errorThrown) {
                console.error("Ajax request failed:", textStatus, errorThrown);
                alert("単語の追加に失敗しました。")
            });
        });
    });
</script>