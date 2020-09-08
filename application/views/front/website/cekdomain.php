<div id="cek_domain">
  <form method="post" action="">
    <label>Domain Name : </label>
    <input type="hidden" value="74e1b6d17a204c8a8c8ede0f2ff1470cb060edcc" name="token"></input>
    <input type="hidden" value="true" name="direct"></input>
    <input  placeholder="tutorial-webdesign" class="inputa" type="text" size="27" name="domain" style="width:430px;" class="inputa"></input>
    <select class="inputa" name="ext" style="font-size:28px;" class="inputa">
      <option value=".com">.com</option>
      <option value=".net">.net</option>
      <option value=".org">.org</option>
      <option value=".info">.info</option>
      <option value=".co.id">.co.id</option>
      <option value=".net.id">.net.id</option>
      <option value=".or.id">.or.id</option>
      <option value="biz.id">.biz.id</option>
      <option value=".ac.id">.ac.id</option>
      <option value=".sch.id">.sch.id</option>
      <option value=".web.id">.web.id</option>
      <option value="dasa.id">.dasa.id</option>
      <option value=".my.id">.my.id</option>
    </select>
    <input class="inputa" name="cek" type="submit" value="Cek" style="font-size:28px;"></input>
  </form>
  <?php
        if (isset($_POST['cek'])) {
            $nama_domain = "$_POST[domain]"."$_POST[ext]";
            $arrHost = @gethostbynamel("$nama_domain");
            if (empty($arrHost)) {
                echo "<div class='hasildomain font-green'>Domain <u><b>$nama_domain</b></u> tersedia, Anda dapat menggunakan domain ini.</div>";
            }
            else {
                echo "<div class='hasildomain font-red'>Domain <u><b>$nama_domain</b></u> sudah digunakan, coba dengan domain lain.</div>";
            }
        }
        ?>
</div>
