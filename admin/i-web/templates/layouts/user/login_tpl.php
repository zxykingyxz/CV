<section class="section_login">
    <div class="bg-blue-500 relative z-10">
        <div class="grid_admin wide h-[100vh]">
            <div class="flex justify-center items-center h-full w-full ">
                <div class="max-w-[calc(100%-20px)] w-[400px] bg-[var(--html-all-admin)] overflow-hidden rounded-xl px-2 sm:px-3 md:px-4 pb-3 pt-7 relative z-10">
                    <form action="" method="POST" name="form_login_admin" class="w-full" enctype="multipart/form-data">
                        <div class=" text-base sm:text-lg lg:text-2xl font-bold text-center text-white uppercase">
                            <span>
                                Đăng nhập quản trị
                            </span>
                        </div>
                        <div class="grid grid-cols-1 gap-3 mt-4">
                            <div class="flex gap-[2px] rounded-md overflow-hidden">
                                <div class="flex-initial bg-white h-full aspect-[1/1] flex justify-center items-center ">
                                    <i class="fas fa-user text-lg text-gray-400"></i>
                                </div>
                                <div class="flex-1 bg-white">
                                    <input type="text" name="username" class="w-full bg-white h-10 px-3 border-none focus:outline-none focus:border-none" required value="" placeholder="Tên đăng nhập">
                                </div>
                            </div>
                            <div class="flex gap-[2px] rounded-md overflow-hidden form_password">
                                <div class="flex-initial bg-white h-full aspect-[1/1] flex justify-center items-center ">
                                    <i class="fas fa-lock text-lg text-gray-400"></i>
                                </div>
                                <div class="flex-1 bg-white">
                                    <input type="password" name="password" class="w-full bg-white h-10 px-3 border-none focus:outline-none focus:border-none" required value="" placeholder="Mật khẩu">
                                </div>
                                <div class=" showPassword group/password bg-white text-sm text-gray-400 h-full aspect-[1/1] z-10 cursor-pointer inline-flex justify-center items-center">
                                    <div class="show_password block group-[.on]/password:hidden">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <div class="hiden_password hidden group-[.on]/password:block">
                                        <i class="fas fa-eye-slash"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-center mt-4">
                            <div class="w-full flex items-center justify-center">
                                <button type="submit" name="submit-resgister-login-admin" class="h-9 sm:h-10 lg:h-11 bg-black hover:bg-blue-500 transition-all duration-300 text-white text-center px-7 rounded-md">
                                    <span class="text-base font-medium uppercase">
                                        Đăng nhập
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="mt-2 flex flex-wrap justify-center gap-2">
                            <div class="flex-initial">
                                <a href="<?= $https_config ?>" title="Vào Website" target="_blank" class=" inline-flex justify-center items-center gap-1 leading-normal text-xs font-normal text-black hover:text-blue-500 transition-all duration-300">
                                    <i class="far fa-share font-black"></i>
                                    <span>
                                        Vào Website
                                    </span>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="particles-js" class="absolute top-0 left-0 w-full h-full  "></div>
    </div>
</section>
<script>
    /* -----------------------------------------------
    /* How to use? : Check the GitHub README
    /* ----------------------------------------------- */

    /* To load a config file (particles.json) you need to host this demo (MAMP/WAMP/local)... */
    /*
    particlesJS.load('particles-js', 'particles.json', function() {
      console.log('particles.js loaded - callback');
    });
    */

    /* Otherwise just put the config content (json): */

    particlesJS('particles-js',

        {
            "particles": {
                "number": {
                    "value": 170,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#ffffff"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    },
                    "polygon": {
                        "nb_sides": 5
                    },
                    "image": {
                        "src": "img/github.svg",
                        "width": 100,
                        "height": 100
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": false,
                    "anim": {
                        "enable": false,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 5,
                    "random": true,
                    "anim": {
                        "enable": false,
                        "speed": 40,
                        "size_min": 0.1,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#ffffff",
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 6,
                    "direction": "none",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "attract": {
                        "enable": false,
                        "rotateX": 600,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "repulse"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 400,
                        "line_linked": {
                            "opacity": 1
                        }
                    },
                    "bubble": {
                        "distance": 400,
                        "size": 40,
                        "duration": 2,
                        "opacity": 8,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 200
                    },
                    "push": {
                        "particles_nb": 4
                    },
                    "remove": {
                        "particles_nb": 2
                    }
                }
            },
            "retina_detect": true,
            "config_demo": {
                "hide_card": false,
                "background_color": "#b61924",
                "background_image": "",
                "background_position": "50% 50%",
                "background_repeat": "no-repeat",
                "background_size": "cover"
            }
        }

    );
    $(document).ready(function() {
        // hiển thị password
        $('body').on("click", ".showPassword", function() {
            var passwordField = $(this).closest('.form_password').find('input[name="password"]');
            var passwordFieldType = passwordField.attr('type');

            if (passwordFieldType === 'password') {
                passwordField.attr('type', 'text');
                $(this).addClass('on');
            } else {
                passwordField.attr('type', 'password');
                $(this).removeClass('on');
            }
        });
        $('form[name="form_login_admin"]').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function(response) {
                    if (response.status === 200) {
                        FRAMEWORK.showNotification({
                            title: 'Thông báo hệ thống',
                            message: response.message,
                            status: "success"
                        });
                        window.location.reload();
                    } else {
                        FRAMEWORK.showNotification({
                            title: 'Thông báo hệ thống',
                            message: response.message,
                            status: "error"
                        });
                    }
                },
                error: function() {
                    alert("Có lỗi xảy ra, vui lòng thử lại!");
                }
            });
        });
    });
</script>