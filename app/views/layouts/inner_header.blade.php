         <ul class="nav nav-tabs" role="tablist">
      <li <?php if($isActive[0]) echo 'class="active"' ?>>
          <a href="/desktop" role="tab" data-toggle="tab">
              <icon class="fa fa-home"></icon> Desktop
          </a>
      </li>
     <li <?php if($isActive[1]) echo 'class="active"' ?>>
      <a href="/friend" role="tab" data-toggle="tab">
          <i class="fa fa-user"></i>Manage Friends
          </a>
      </li>
      <li <?php if($isActive[2]) echo 'class="active"' ?>>
      
          <a href="/account/create" role="tab" data-toggle="tab">
              <i class="fa fa-envelope"></i>Manage Account
          </a>
      </li>
  <li <?php if($isActive[3]) echo 'class="active"' ?>>
          <a href="/account" role="tab" data-toggle="tab">
              <i class="fa fa-envelope"></i>All Accounts
          </a>
      </li>
     
     
    </ul>