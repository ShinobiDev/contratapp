<script type="text/javascript">
     /**
         * Funcion para el obj data table desde url
         * @return {[type]} [description]
         */
        function filtro_url (obj) {
            if(window.location.search.split("=")[1]!=undefined){
                $(obj).DataTable().search(
                    
                        decodeURIComponent(window.location.search.split("=")[1]),
                    
                    
                    true,                    
                ).draw();

            }
        }
</script>