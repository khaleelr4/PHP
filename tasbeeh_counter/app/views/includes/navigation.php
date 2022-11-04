<div class="row">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a id="navicon" class="navbar-brand" href="<?=URLROOT?>/">
                <img src="<?=URLROOT?>/public/img/kaaba.png" alt="" width="50" height="50" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?=$data['view'] == 'home' ? 'active' : ''?>" aria-current="page" href="<?=URLROOT?>/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?=$data['view'] == 'about' ? 'active' : ''?>" aria-current="page" href="<?=URLROOT?>/about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?=$data['view'] == 'contact' ? 'active' : ''?>" aria-current="page" href="<?=URLROOT?>/contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?=$data['view'] == 'stats' ? 'active' : ''?>" aria-current="page" href="<?=URLROOT?>/home/stats">Stats</a>
                    </li>
                    <?php if($session_helper->is_session_exists("user_object")){?>
                        <li class="nav-item">
                            <a class="nav-link <?=$data['view'] == 'User Stats' ? 'active' : ''?>" aria-current="page" href="<?=URLROOT?>/home/user_stats">My Stats</a>
                        </li>
                    <?php }?>
                </ul>
                <div class="d-flex">
                    <?php if(!$session_helper->is_session_exists("user_object")){?>
                        <button class="btn btn-outline-primary" type="button" onclick="loginmodalinstance.show();">Login</button>
                    <?php }else{?>
                        <a href="<?=URLROOT?>/home/logout" class="btn btn-outline-danger">Logout</a>
                    <?php }?>
                </div>
            </div>
        </div>
    </nav>
</div>