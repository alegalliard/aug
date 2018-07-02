<div id="content">
            <h2>Candidatos para adoção Petz</h2>

<form name="cat" id="cat" action="http://aug.alesouza.com/adm/gatos/adotados/1" method="post">
    <input type="hidden" id="current_page" value="1">
    <input type="hidden" id="total_pages" value="80">

    <!-- <p>
        Buscar Gato: <input type="text" id="search" name="search" value="">
        Ordenar:
        <select type="select" id="order" name="order">
            <option value="name ASC">Alfabética A-Z</option>
            <option value="name DESC">Alfabética Z-A</option>
            <option value="registry_date DESC" selected="selected">Data do Cadastro</option>
        </select>
        <input type="submit" value="OK" class="ui-button ui-widget ui-state-default ui-corner-all" role="button" aria-disabled="false">

        <span class="pagination">
             Página  1 de 80  <span class="pagination-next">Next</span>         </span>
    </p> -->
</form>

<table width="100%" border="1">
    <thead>
        <tr>
          <th>Empresa</th>
            <th>Gato</th>
            <th>Candidatos</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
          <td>Petz</td>
            <td>Amor Purrfeito</td>
            <td>7</td>
            <td><a href="/adm/gatos/fila-de-espera/gato/87661">Detalhes</a></td>
        </tr>
      </tbody>
</table>


<script type="text/javascript">
$(document).ready(function(){

    $(".fancybox").fancybox();

    var action = $('#cat').attr('action');

    var current_page = eval($("#current_page").val());
    var total_pages  = eval($("#total_pages").val());

    $(".pagination-next").click(function(){
        if(current_page != total_pages)
        {
            $('#cat').attr('action', action.replace(action.substr(action.lastIndexOf('/')), "/"+eval(current_page+1)));
            $('#cat').submit();
        }
    });

    $(".pagination-prev").click(function(){
        if(current_page > 0)
        {
            $('#cat').attr('action', action.replace(action.substr(action.lastIndexOf('/')), "/"+eval(current_page-1)));
            $('#cat').submit();
        }
    });
});
</script>        </div>
