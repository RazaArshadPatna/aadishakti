<?php
// Read Menu Data
 $Getmenudata = file_get_contents('menudata.json');
 $menudata=json_decode($Getmenudata,true);
 $show=false;
?>
<div class="sidebar p-2 py-md-3 @@cardClass">
    <div class="container-fluid">
        <!-- sidebar: title-->
        <div class="title-text d-flex align-items-center mb-4 mt-1">
            <h4 class="sidebar-title mb-0 flex-grow-1"><span
                    class="sm-txt"><?php echo substr($webname,0,1); ?></span><span><?php echo substr($webname,1);?></span>
            </h4>

        </div>

        <!-- sidebar: menu list -->
        <div class="main-menu flex-grow-1">
            <ul class="menu-list">

                <li>
                    <a class="m-link menu-dashboard" href="index.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                            <path class="fill-secondary" fill-rule="evenodd"
                                d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                        </svg>
                        <span class="ms-2">My Dashboard</span>
                    </a>
                </li>

                <?php if(in_array('Admin',$menudata) || in_array('Today Login',$menudata)){ ?>

                <li class="collapsed">
                    <a class="m-link menu-administration" data-bs-toggle="collapse"
                        data-bs-target="#menu-administration" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M5.5 2A3.5 3.5 0 0 0 2 5.5v5A3.5 3.5 0 0 0 5.5 14h5a3.5 3.5 0 0 0 3.5-3.5V8a.5.5 0 0 1 1 0v2.5a4.5 4.5 0 0 1-4.5 4.5h-5A4.5 4.5 0 0 1 1 10.5v-5A4.5 4.5 0 0 1 5.5 1H8a.5.5 0 0 1 0 1H5.5z" />
                            <path class="fill-secondary" d="M16 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        </svg>
                        <span class="ms-2">Administration</span>
                        <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                    </a>
                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse" id="menu-administration">
                        <?php if(in_array('Admin',$menudata)){ ?>
                        <li><a class="ms-link menu-administration-admin"
                                href="administration-admin-user-dis.php">Admin</a></li>
                        <?php } ?>
                        <?php if(in_array('Today Login',$menudata) && $show==true){ ?>
                        <li><a class="ms-link menu-administration-today" href="administration-today-login-dis.php">Today
                                Login</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>

                <?php if(in_array('Slider',$menudata) || in_array('Static Page',$menudata) || in_array('Gallery',$menudata) || in_array('Testimonial',$menudata) || in_array('Web Information',$menudata) || in_array('Our Team',$menudata) || in_array('Service',$menudata) || in_array('Product',$menudata) || in_array('Project',$menudata) || in_array('Why Choose Us',$menudata) || in_array('Blog',$menudata)){ ?>
                <li class="collapsed">
                    <a class="m-link menu-web" data-bs-toggle="collapse" data-bs-target="#menu-web" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2 1C1.46957 1 0.960859 1.21071 0.585786 1.58579C0.210714 1.96086 0 2.46957 0 3L0 13C0 13.5304 0.210714 14.0391 0.585786 14.4142C0.960859 14.7893 1.46957 15 2 15H14C14.5304 15 15.0391 14.7893 15.4142 14.4142C15.7893 14.0391 16 13.5304 16 13V3C16 2.46957 15.7893 1.96086 15.4142 1.58579C15.0391 1.21071 14.5304 1 14 1H2ZM1 3C1 2.73478 1.10536 2.48043 1.29289 2.29289C1.48043 2.10536 1.73478 2 2 2H14C14.2652 2 14.5196 2.10536 14.7071 2.29289C14.8946 2.48043 15 2.73478 15 3V13C15 13.2652 14.8946 13.5196 14.7071 13.7071C14.5196 13.8946 14.2652 14 14 14H2C1.73478 14 1.48043 13.8946 1.29289 13.7071C1.10536 13.5196 1 13.2652 1 13V3ZM2 5.5C2 5.36739 2.05268 5.24021 2.14645 5.14645C2.24021 5.05268 2.36739 5 2.5 5H6C6.13261 5 6.25979 5.05268 6.35355 5.14645C6.44732 5.24021 6.5 5.36739 6.5 5.5C6.5 5.63261 6.44732 5.75979 6.35355 5.85355C6.25979 5.94732 6.13261 6 6 6H2.5C2.36739 6 2.24021 5.94732 2.14645 5.85355C2.05268 5.75979 2 5.63261 2 5.5ZM2 8.5C2 8.36739 2.05268 8.24021 2.14645 8.14645C2.24021 8.05268 2.36739 8 2.5 8H6C6.13261 8 6.25979 8.05268 6.35355 8.14645C6.44732 8.24021 6.5 8.36739 6.5 8.5C6.5 8.63261 6.44732 8.75979 6.35355 8.85355C6.25979 8.94732 6.13261 9 6 9H2.5C2.36739 9 2.24021 8.94732 2.14645 8.85355C2.05268 8.75979 2 8.63261 2 8.5ZM2 10.5C2 10.3674 2.05268 10.2402 2.14645 10.1464C2.24021 10.0527 2.36739 10 2.5 10H6C6.13261 10 6.25979 10.0527 6.35355 10.1464C6.44732 10.2402 6.5 10.3674 6.5 10.5C6.5 10.6326 6.44732 10.7598 6.35355 10.8536C6.25979 10.9473 6.13261 11 6 11H2.5C2.36739 11 2.24021 10.9473 2.14645 10.8536C2.05268 10.7598 2 10.6326 2 10.5Z" />
                            <path class="fill-secondary"
                                d="M8.5 11C8.5 11 8 11 8 10.5C8 10 8.5 8.5 11 8.5C13.5 8.5 14 10 14 10.5C14 11 13.5 11 13.5 11H8.5ZM11 8C11.3978 8 11.7794 7.84196 12.0607 7.56066C12.342 7.27936 12.5 6.89782 12.5 6.5C12.5 6.10218 12.342 5.72064 12.0607 5.43934C11.7794 5.15804 11.3978 5 11 5C10.6022 5 10.2206 5.15804 9.93934 5.43934C9.65804 5.72064 9.5 6.10218 9.5 6.5C9.5 6.89782 9.65804 7.27936 9.93934 7.56066C10.2206 7.84196 10.6022 8 11 8V8Z" />
                        </svg>
                        <span class="ms-2">Dynamic Page</span>
                        <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                    </a>
                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse" id="menu-web">
                        <?php if(in_array('Static Page',$menudata)){ ?>
                        <li><a class="ms-link menu-web-static" href="web-static-pages-dis.php"> Manage Static Page</a>
                        </li>
                        <?php } ?>
                        <?php if(in_array('Slider',$menudata)){ ?>
                        <li><a class="ms-link menu-web-slider" href="web-home-slider-dis.php">Manage Slider</a></li>
                        <?php } ?>
                        <?php if(in_array('Gallery',$menudata)){ ?>
                        <li><a class="ms-link menu-web-gallery" href="gallery-dis.php"> Manage Gallery</a></li>
                        <?php } ?>
                        <?php if(in_array('Legal Document1',$menudata)){ ?>
                        <li><a class="ms-link menu-web-legal" href="legal-dis.php"> Manage Legal Document</a></li>
                        <?php } ?>
                        <?php if(in_array('Our Team1',$menudata)){ ?>
                        <li><a class="ms-link menu-web-our-team" href="our-team-dis.php"> Manage Team</a></li>
                        <?php } ?>
                        <?php if(in_array('Blog',$menudata)){ ?>
                        <li><a class="ms-link menu-web-blog" href="blog-dis.php"> Manage News</a></li>
                        <?php } ?>
                       
                        <?php if(in_array('Service1',$menudata)){ ?>
                        <li><a class="ms-link menu-web-service" href="service-dis.php"> Service</a></li>
                        <?php } ?>
                        <?php if(in_array('Product',$menudata)){ ?>
                        <li><a class="ms-link menu-web-product" href="product-dis.php"> Manage Services</a></li>
                        <?php } ?>
                        <?php if(in_array('Project1',$menudata)){ ?>
                        <li><a class="ms-link menu-web-project" href="project-dis.php"> Project</a></li>
                        <?php } ?>
                        <?php if(in_array('Why Choose Us',$menudata)){ ?>
                        <!-- <li><a class="ms-link menu-web-why" href="why-dis.php"> Why Choose Us</a></li> -->
                        <?php } ?>
                        <?php if(in_array('Testimonial',$menudata)){ ?>
                        <li><a class="ms-link menu-web-testimonial" href="testimonial-dis.php"> Manage Testimonials</a>
                        </li>
                        <?php } ?>
                        <?php if(in_array('Web Information',$menudata)){ ?>
                        <li><a class="ms-link menu-web-information" href="web-information.php"> Website Information</a>
                        </li>
                        <?php }?>
                        <?php if(in_array('Moving Text',$menudata)){ ?>
                        <!-- <li><a class="ms-link menu-news" href="download-dis.php">Manage Download</a> -->
                        </li>
                        <?php } ?>
                        <?php if(in_array('Moving Text',$menudata)){ ?>
                        <!-- <li><a class="ms-link menu-education" href="education-dis.php">Manage Education</a> -->
                        </li>
                        <?php } ?>
                        <?php if(in_array('Moving Text',$menudata)){ ?>
                        <li><a class="ms-link menu-brand" href="our-team-dis.php">Manage Videos</a>
                        </li>
                        <?php } ?>
                        <?php if(in_array('career',$menudata)){ ?>
                        <!-- <li><a class="ms-link menu-career" href="career-dis.php">Manage Career</a> -->
                        </li>
                        <?php } ?>
                        <?php if(in_array('career',$menudata)){ ?>
                        <!-- <li><a class="ms-link menu-job" href="job-dis.php">Manage Job description</a> -->
                        </li>
                        <?php } ?>
                        <?php if(in_array('Manage Employee',$menudata)){ ?>
                        <!-- <li><a class="ms-link menu-employee" href="employee-dis.php">Manage Employee</a> -->
                        </li>
                        <?php } ?>
                        <?php if(in_array('Manage Distributor',$menudata)){ ?>
                        <!-- <li><a class="ms-link menu-distributor" href="distributor-dis.php">Manage Distributor</a> -->
                        </li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
                <?php if(in_array('View Contact',$menudata)){ ?>
                <!-- <li>
                    <a class="m-link menu-contact" href="contact-dis.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M0 3H16V4H0V3Z" />
                            <path d="M9 1H14V6H9V1Z" />
                            <path d="M0 13H16V14H0V13Z" />
                            <path d="M9 11H14V16H9V11Z" />
                            <path class="fill-secondary" d="M0 8H16V9H0V8Z" />
                            <path class="fill-secondary" d="M2 6H7V11H2V6Z" />
                        </svg>
                        <span class="ms-2">View Contacts</span>
                    </a>
                </li> -->
                <?php } ?>
                <?php if(in_array('View Inquiry',$menudata)){ ?>
                <li>
                    <a class="m-link menu-inquiry" href="inquiry-dis.php">
                        <i class="fa fa-info"></i>
                        <span class="ms-2">View Inquiry</span>
                    </a>
                </li>
                <?php } ?>
                <?php if(in_array('View Inquiry',$menudata)){ ?>
                <!-- <li>
                    <a class="m-link menu-job" href="job-apply-dis.php">
                        <i class="fa fa-info"></i>
                        <span class="ms-2">View Job Applied</span>
                    </a>
                </li> -->
                <?php } ?>
                <?php if(in_array('View Inquiry',$menudata)){ ?>
                <!-- <li>
                    <a class="m-link menu-egroup" href="employee-group-dis.php">
                        <i class="fa fa-info"></i>
                        <span class="ms-2">View Employee(Group Members)</span>
                    </a>
                </li> -->
                <!-- <li>
                    <a class="m-link menu-agroup" href="view-all-members.php">
                        <i class="fa fa-info"></i>
                        <span class="ms-2">View All Members</span>
                    </a>
                </li> -->
                <!-- <li>
                    <a class="m-link menu-distributor" href="distributor-dis.php">
                        <i class="fa fa-info"></i>
                        <span class="ms-2">View Distributors</span>
                    </a>
                </li> -->
                <!-- <li>
                    <a class="m-link menu-withdrawal" href="withdrawal-dis.php">
                        <i class="fa fa-info"></i>
                        <span class="ms-2">View Withdrwal Request</span>
                    </a>
                </li> -->
                <?php } ?>
                
               

                <?php if(in_array('Create New',$menudata)){ ?>
                <li>
                    <a class="m-link menu-create" href="create-new.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                            <path class="fill-secondary" fill-rule="evenodd"
                                d="M8.646 5.646a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L10.293 8 8.646 6.354a.5.5 0 0 1 0-.708zm-1.292 0a.5.5 0 0 0-.708 0l-2 2a.5.5 0 0 0 0 .708l2 2a.5.5 0 0 0 .708-.708L5.707 8l1.647-1.646a.5.5 0 0 0 0-.708z">
                            </path>
                            <path
                                d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z">
                            </path>
                            <path
                                d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z">
                            </path>
                        </svg>
                        <span class="ms-2">Create New</span>
                    </a>
                </li>
                <?php } ?>

                <!--<li class="collapsed">
            <a class="m-link menu-master" data-bs-toggle="collapse" data-bs-target="#menu-master" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M2 1C1.46957 1 0.960859 1.21071 0.585786 1.58579C0.210714 1.96086 0 2.46957 0 3L0 13C0 13.5304 0.210714 14.0391 0.585786 14.4142C0.960859 14.7893 1.46957 15 2 15H14C14.5304 15 15.0391 14.7893 15.4142 14.4142C15.7893 14.0391 16 13.5304 16 13V3C16 2.46957 15.7893 1.96086 15.4142 1.58579C15.0391 1.21071 14.5304 1 14 1H2ZM1 3C1 2.73478 1.10536 2.48043 1.29289 2.29289C1.48043 2.10536 1.73478 2 2 2H14C14.2652 2 14.5196 2.10536 14.7071 2.29289C14.8946 2.48043 15 2.73478 15 3V13C15 13.2652 14.8946 13.5196 14.7071 13.7071C14.5196 13.8946 14.2652 14 14 14H2C1.73478 14 1.48043 13.8946 1.29289 13.7071C1.10536 13.5196 1 13.2652 1 13V3ZM2 5.5C2 5.36739 2.05268 5.24021 2.14645 5.14645C2.24021 5.05268 2.36739 5 2.5 5H6C6.13261 5 6.25979 5.05268 6.35355 5.14645C6.44732 5.24021 6.5 5.36739 6.5 5.5C6.5 5.63261 6.44732 5.75979 6.35355 5.85355C6.25979 5.94732 6.13261 6 6 6H2.5C2.36739 6 2.24021 5.94732 2.14645 5.85355C2.05268 5.75979 2 5.63261 2 5.5ZM2 8.5C2 8.36739 2.05268 8.24021 2.14645 8.14645C2.24021 8.05268 2.36739 8 2.5 8H6C6.13261 8 6.25979 8.05268 6.35355 8.14645C6.44732 8.24021 6.5 8.36739 6.5 8.5C6.5 8.63261 6.44732 8.75979 6.35355 8.85355C6.25979 8.94732 6.13261 9 6 9H2.5C2.36739 9 2.24021 8.94732 2.14645 8.85355C2.05268 8.75979 2 8.63261 2 8.5ZM2 10.5C2 10.3674 2.05268 10.2402 2.14645 10.1464C2.24021 10.0527 2.36739 10 2.5 10H6C6.13261 10 6.25979 10.0527 6.35355 10.1464C6.44732 10.2402 6.5 10.3674 6.5 10.5C6.5 10.6326 6.44732 10.7598 6.35355 10.8536C6.25979 10.9473 6.13261 11 6 11H2.5C2.36739 11 2.24021 10.9473 2.14645 10.8536C2.05268 10.7598 2 10.6326 2 10.5Z" />
                <path class="fill-secondary" d="M8.5 11C8.5 11 8 11 8 10.5C8 10 8.5 8.5 11 8.5C13.5 8.5 14 10 14 10.5C14 11 13.5 11 13.5 11H8.5ZM11 8C11.3978 8 11.7794 7.84196 12.0607 7.56066C12.342 7.27936 12.5 6.89782 12.5 6.5C12.5 6.10218 12.342 5.72064 12.0607 5.43934C11.7794 5.15804 11.3978 5 11 5C10.6022 5 10.2206 5.15804 9.93934 5.43934C9.65804 5.72064 9.5 6.10218 9.5 6.5C9.5 6.89782 9.65804 7.27936 9.93934 7.56066C10.2206 7.84196 10.6022 8 11 8V8Z" />
              </svg>
              <span class="ms-2">Master Data</span>
              <span class="arrow fa fa-angle-right ms-auto text-end"></span>
            </a>
            <ul class="sub-menu collapse" id="menu-master">
              <li><a class="ms-link menu-master-main-menu" href="main-menu-dis.php"> Main Menu</a></li>
              <li><a class="ms-link menu-master-sub-menu" href="sub-menu-dis.php">Sub Menu</a></li>
			  
            </ul>
          </li>
		  
		  -->
      <?php if(in_array('Master',$menudata)){ ?>
                  <!-- <li class="collapsed">
                    <a class="m-link menu-master" data-bs-toggle="collapse" data-bs-target="#menu-master" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2 1C1.46957 1 0.960859 1.21071 0.585786 1.58579C0.210714 1.96086 0 2.46957 0 3L0 13C0 13.5304 0.210714 14.0391 0.585786 14.4142C0.960859 14.7893 1.46957 15 2 15H14C14.5304 15 15.0391 14.7893 15.4142 14.4142C15.7893 14.0391 16 13.5304 16 13V3C16 2.46957 15.7893 1.96086 15.4142 1.58579C15.0391 1.21071 14.5304 1 14 1H2ZM1 3C1 2.73478 1.10536 2.48043 1.29289 2.29289C1.48043 2.10536 1.73478 2 2 2H14C14.2652 2 14.5196 2.10536 14.7071 2.29289C14.8946 2.48043 15 2.73478 15 3V13C15 13.2652 14.8946 13.5196 14.7071 13.7071C14.5196 13.8946 14.2652 14 14 14H2C1.73478 14 1.48043 13.8946 1.29289 13.7071C1.10536 13.5196 1 13.2652 1 13V3ZM2 5.5C2 5.36739 2.05268 5.24021 2.14645 5.14645C2.24021 5.05268 2.36739 5 2.5 5H6C6.13261 5 6.25979 5.05268 6.35355 5.14645C6.44732 5.24021 6.5 5.36739 6.5 5.5C6.5 5.63261 6.44732 5.75979 6.35355 5.85355C6.25979 5.94732 6.13261 6 6 6H2.5C2.36739 6 2.24021 5.94732 2.14645 5.85355C2.05268 5.75979 2 5.63261 2 5.5ZM2 8.5C2 8.36739 2.05268 8.24021 2.14645 8.14645C2.24021 8.05268 2.36739 8 2.5 8H6C6.13261 8 6.25979 8.05268 6.35355 8.14645C6.44732 8.24021 6.5 8.36739 6.5 8.5C6.5 8.63261 6.44732 8.75979 6.35355 8.85355C6.25979 8.94732 6.13261 9 6 9H2.5C2.36739 9 2.24021 8.94732 2.14645 8.85355C2.05268 8.75979 2 8.63261 2 8.5ZM2 10.5C2 10.3674 2.05268 10.2402 2.14645 10.1464C2.24021 10.0527 2.36739 10 2.5 10H6C6.13261 10 6.25979 10.0527 6.35355 10.1464C6.44732 10.2402 6.5 10.3674 6.5 10.5C6.5 10.6326 6.44732 10.7598 6.35355 10.8536C6.25979 10.9473 6.13261 11 6 11H2.5C2.36739 11 2.24021 10.9473 2.14645 10.8536C2.05268 10.7598 2 10.6326 2 10.5Z" />
                            <path class="fill-secondary"
                                d="M8.5 11C8.5 11 8 11 8 10.5C8 10 8.5 8.5 11 8.5C13.5 8.5 14 10 14 10.5C14 11 13.5 11 13.5 11H8.5ZM11 8C11.3978 8 11.7794 7.84196 12.0607 7.56066C12.342 7.27936 12.5 6.89782 12.5 6.5C12.5 6.10218 12.342 5.72064 12.0607 5.43934C11.7794 5.15804 11.3978 5 11 5C10.6022 5 10.2206 5.15804 9.93934 5.43934C9.65804 5.72064 9.5 6.10218 9.5 6.5C9.5 6.89782 9.65804 7.27936 9.93934 7.56066C10.2206 7.84196 10.6022 8 11 8V8Z" />
                        </svg>
                        <span class="ms-2">Master</span>
                        <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                    </a>
                  
                    <ul class="sub-menu collapse" id="menu-master">
                        <?php if(in_array('Master Category',$menudata)){ ?>
                        <li><a class="ms-link menu-web-master-category" href="master-category.php"> Add Master Category</a>
                        </li>
                        <li><a class="ms-link menu-web-master-state" href="master-state.php"> Add Master State</a>
                        </li>
                        <li><a class="ms-link menu-web-master-post" href="master-post.php"> Add Master Posts</a>
                        </li>
                        <li><a class="ms-link menu-web-master-reg" href="master-reg-dis.php"> Add Farmer Registration Amount</a>
                        </li>
                        <li><a class="ms-link menu-web-master-dis" href="master-dis-reg-dis.php"> Add Distributor Registration Amount</a>
                        </li>
                        <li><a class="ms-link menu-web-master-setting" href="setting-dis.php">Settings</a>
                        </li>
                        <?php } ?>
                        
                    </ul>
                </li> -->
                <?php } ?>

            </ul>

        </div>
        <!-- sidebar: footer link -->
        <!-- sidebar: footer link -->
        <ul class="menu-list nav navbar-nav flex-row text-center menu-footer-link">

            <li class="nav-item flex-fill p-2">
                <a class="d-inline-block w-100 color-400" href="./logout.php" title="sign-out">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M7.5 1v7h1V1h-1z" />
                        <path class="fill-secondary"
                            d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z" />
                    </svg>
                </a>
            </li>
        </ul>
    </div>
</div>