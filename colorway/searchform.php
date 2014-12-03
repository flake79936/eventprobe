<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
     <div>
          <input type="text" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}"  value="Search" name="s" id="s" />
          <input type="submit" id="searchsubmit" value="Search" />
     </div>
</form>
<div class="clear"></div>