<!--    NAVBAR     -->
<div class="col-12">
    <nav class="navbar navbar-expand-lg bg-dark mb-3">
        <div class="container-fluid">
            <div class="container  col-3 m-0">
                <!-- <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                    aria-controls="offcanvasExample">
                    Button with data-bs-target
                </button> -->
                <a class="navbar-brand" href="#"><i class="fa-solid fa-flask"></i> Itahitilab</a>
            </div>
           
               
            </div>
            <div class="container col-3 m-0">
                <form action="deconnection.php" method="post">
                    <input name="deconnex" type="hidden" value="deconnexion" />
                    <input name="email" type="hidden" value="<?php echo($_SESSION['email']);?>" />
                    <input class="unlink" type="submit" value="" />
                </form>
                <ul class="nav justify-content-end">
                    <li class="nav-item text-white d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="35" height="35"
                            viewBox="0 0 172 172" style=" fill:#000000;">
                            <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                                stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                                font-family="none" font-weight="none" font-size="none" text-anchor="none"
                                style="mix-blend-mode: normal">
                                <path d="M0,172v-172h172v172z" fill="none"></path>
                                <g fill="#ffffff">
                                    <path
                                        d="M136.16667,143.33333h-100.33333c-4.3,0 -7.16667,-2.86667 -7.16667,-7.16667v-100.33333c0,-4.3 2.86667,-7.16667 7.16667,-7.16667h100.33333c4.3,0 7.16667,2.86667 7.16667,7.16667v100.33333c0,4.3 -2.86667,7.16667 -7.16667,7.16667z"
                                        opacity="0.3">

                                    </path>
                                    <path
                                        d="M136.16667,150.5h-100.33333c-7.88333,0 -14.33333,-6.45 -14.33333,-14.33333v-100.33333c0,-7.88333 6.45,-14.33333 14.33333,-14.33333h100.33333c7.88333,0 14.33333,6.45 14.33333,14.33333v100.33333c0,7.88333 -6.45,14.33333 -14.33333,14.33333zM136.16667,136.16667v7.16667v-7.16667zM35.83333,35.83333v100.33333h100.33333v-100.33333z">
                                    </path>
                                    <path d="M64.5,78.83333h64.5v14.33333h-64.5z">

                                    </path>
                                    <path
                                        d="M112.51667,119.68333l-10.03333,-10.03333l23.65,-23.65l-23.65,-23.65l10.03333,-10.03333l33.68333,33.68333z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                        Déconnexion
                        <div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>