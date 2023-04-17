<div>
    {!!$udoc->html!!}
    <script>
             window.print();
             //setTimeout(window.close, 5);
    </script>
</div>


<style>

@media print {
    @page {
        margin-top: 0;
        margin-bottom: 0;
    }
    body {
        padding-top: 72px;
        padding-bottom: 72px ;
    }
}



</style>
