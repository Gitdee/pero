@if(!isset($no_padding))
<footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong>Copyright &copy; 
    @php
      echo  date("Y");
    @endphp
</footer>
@endif