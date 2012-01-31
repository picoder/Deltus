<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open('panel-administracyjny/test');
?>
<select data-placeholder="Your Favorite Types of Bear" style="width:350px;" multiple class="chzn-select" id="test_me" name="categories[]" tabindex="8">
<option value=""></option>
<option>American Black Bear</option>
<option>Asiatic Black Bear</option>
<option>Brown Bear</option>
<option>Giant Panda</option>
<option>Sloth Bear</option>
<option>Sun Bear</option>
<option>Polar Bear</option>
<option>Spectacled Bear</option>
</select>
<br>
<ul id="example">
<li>
KatC1
<ul>
<li>
<label><input type="checkbox" name="c1.1">KatC1.1</label>
<ul>
<li>
<label><input type="checkbox" name="c1.1.1">KatC1.1.1</label>
</li>
<li>
<label><input type="checkbox" name="c1.1.2">KatC1.1.2</label>
</li>
</ul>
</li>
<li>
<label><input type="checkbox" name="c1.2">KatC1.2</label>
</li>
</ul>
</li>
</ul>
<br><br>

  <br>
<input type="submit">
<script src="<?php echo base_url(); ?>extends/chosen/chosen.jquery.js" type="text/javascript"></script>

<script type="text/javascript"> 

$(document).ready(function(){
$(".chzn-select").chosen();


});
</script>


</form>