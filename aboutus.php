<?php
require_once "db_connection.php";
require_once "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/aboutus.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>
    <div class="background">
        <img class="bkgr" src="/Images/backgr.jpg" alt="">
        <div class="hero">
            <div class="left">
                <h1 class="title">Our Story</h1>
            </div>
            <div class="card-container">
                <div class="card">
                    <img class="img-content" src="images/team.jpg" alt="">
                    <div class="content">
                        <p class="heading">Card Hover</p>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipii
                            voluptas ten mollitia pariatur odit, ab
                            minus ratione adipisci accusamus vel est excepturi laboriosam magnam
                            necessitatibus dignissimos molestias.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="heading-container">
            <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo minima recusandae id unde consequatur modi officiis facere, placeat ex, ullam dignissimos molestiae autem atque in doloribus! Laborum quo error officiis!</h5>
        </div>
        <div class="card-carousel">
            <div class="card" id="1">
                <div class="image-container"></div>
                <p>1 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, explicabo!</p>
            </div>
            <div class="card" id="2">
                <div class="image-container"></div>
                <p>2 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, explicabo!</p>
            </div>
            <div class="card" id="3">
                <div class="image-container"></div>
                <p>3 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, explicabo!</p>
            </div>
            <div class="card" id="4">
                <div class="image-container"></div>
                <p>4 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, explicabo!</p>
            </div>
            <div class="card" id="5">
                <div class="image-container"></div>
                <p>5 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, explicabo!</p>
            </div>
        </div>
        <a href="#" class="visuallyhidden card-controller">Carousel controller</a>
    </div>
    <a href="courses.php">
        <button>Check Their Courses</button>
    </a>
    <div id="Carousel-slider">
        <section>
            <div class="Carousel-slider">
                <!-- Background Images div -->
                <div class="slider-item superHero1" data-href="#"></div>
                <div class="slider-item superHero2" data-href="#"></div>
                <div class="slider-item superHero3" data-href="#"></div>
                <div class="slider-item superHero4" data-href="#"></div>
                <div class="slider-item superHero5" data-href="#"></div>
                <div class="slider-item superHero6" data-href="#"></div>
                <div class="slider-item superHero7" data-href="#"></div>
                <!-- Background Images div End -->
            </div>
        </section>
    </div>
    <script>
        const cardsContainer = document.querySelector(".card-carousel");
        const cardsController = document.querySelector(".card-carousel + .card-controller")

        class DraggingEvent {
            constructor(target = undefined) {
                this.target = target;
            }

            event(callback) {
                let handler;

                this.target.addEventListener("mousedown", e => {
                    e.preventDefault()

                    handler = callback(e)

                    window.addEventListener("mousemove", handler)

                    document.addEventListener("mouseleave", clearDraggingEvent)

                    window.addEventListener("mouseup", clearDraggingEvent)

                    function clearDraggingEvent() {
                        window.removeEventListener("mousemove", handler)
                        window.removeEventListener("mouseup", clearDraggingEvent)

                        document.removeEventListener("mouseleave", clearDraggingEvent)

                        handler(null)
                    }
                })

                this.target.addEventListener("touchstart", e => {
                    handler = callback(e)

                    window.addEventListener("touchmove", handler)

                    window.addEventListener("touchend", clearDraggingEvent)

                    document.body.addEventListener("mouseleave", clearDraggingEvent)

                    function clearDraggingEvent() {
                        window.removeEventListener("touchmove", handler)
                        window.removeEventListener("touchend", clearDraggingEvent)

                        handler(null)
                    }
                })
            }

            // Get the distance that the user has dragged
            getDistance(callback) {
                function distanceInit(e1) {
                    let startingX, startingY;

                    if ("touches" in e1) {
                        startingX = e1.touches[0].clientX
                        startingY = e1.touches[0].clientY
                    } else {
                        startingX = e1.clientX
                        startingY = e1.clientY
                    }


                    return function(e2) {
                        if (e2 === null) {
                            return callback(null)
                        } else {

                            if ("touches" in e2) {
                                return callback({
                                    x: e2.touches[0].clientX - startingX,
                                    y: e2.touches[0].clientY - startingY
                                })
                            } else {
                                return callback({
                                    x: e2.clientX - startingX,
                                    y: e2.clientY - startingY
                                })
                            }
                        }
                    }
                }

                this.event(distanceInit)
            }
        }


        class CardCarousel extends DraggingEvent {
            constructor(container, controller = undefined) {
                super(container)

                // DOM elements
                this.container = container
                this.controllerElement = controller
                this.cards = container.querySelectorAll(".card")

                // Carousel data
                this.centerIndex = (this.cards.length - 1) / 2;
                this.cardWidth = this.cards[0].offsetWidth / this.container.offsetWidth * 100
                this.xScale = {};

                // Resizing
                window.addEventListener("resize", this.updateCardWidth.bind(this))

                if (this.controllerElement) {
                    this.controllerElement.addEventListener("keydown", this.controller.bind(this))
                }


                // Initializers
                this.build()

                // Bind dragging event
                super.getDistance(this.moveCards.bind(this))
            }

            updateCardWidth() {
                this.cardWidth = this.cards[0].offsetWidth / this.container.offsetWidth * 100

                this.build()
            }

            build(fix = 0) {
                for (let i = 0; i < this.cards.length; i++) {
                    const x = i - this.centerIndex;
                    const scale = this.calcScale(x)
                    const scale2 = this.calcScale2(x)
                    const zIndex = -(Math.abs(i - this.centerIndex))

                    const leftPos = this.calcPos(x, scale2)


                    this.xScale[x] = this.cards[i]

                    this.updateCards(this.cards[i], {
                        x: x,
                        scale: scale,
                        leftPos: leftPos,
                        zIndex: zIndex
                    })
                }
            }


            controller(e) {
                const temp = {
                    ...this.xScale
                };

                if (e.keyCode === 39) {
                    // Left arrow
                    for (let x in this.xScale) {
                        const newX = (parseInt(x) - 1 < -this.centerIndex) ? this.centerIndex : parseInt(x) - 1;

                        temp[newX] = this.xScale[x]
                    }
                }

                if (e.keyCode == 37) {
                    // Right arrow
                    for (let x in this.xScale) {
                        const newX = (parseInt(x) + 1 > this.centerIndex) ? -this.centerIndex : parseInt(x) + 1;

                        temp[newX] = this.xScale[x]
                    }
                }

                this.xScale = temp;

                for (let x in temp) {
                    const scale = this.calcScale(x),
                        scale2 = this.calcScale2(x),
                        leftPos = this.calcPos(x, scale2),
                        zIndex = -Math.abs(x)

                    this.updateCards(this.xScale[x], {
                        x: x,
                        scale: scale,
                        leftPos: leftPos,
                        zIndex: zIndex
                    })
                }
            }

            calcPos(x, scale) {
                let formula;

                if (x < 0) {
                    formula = (scale * 100 - this.cardWidth) / 2

                    return formula

                } else if (x > 0) {
                    formula = 100 - (scale * 100 + this.cardWidth) / 2

                    return formula
                } else {
                    formula = 100 - (scale * 100 + this.cardWidth) / 2

                    return formula
                }
            }

            updateCards(card, data) {
                if (data.x || data.x == 0) {
                    card.setAttribute("data-x", data.x)
                }

                if (data.scale || data.scale == 0) {
                    card.style.transform = `scale(${data.scale})`

                    if (data.scale == 0) {
                        card.style.opacity = data.scale
                    } else {
                        card.style.opacity = 1;
                    }
                }

                if (data.leftPos) {
                    card.style.left = `${data.leftPos}%`
                }

                if (data.zIndex || data.zIndex == 0) {
                    if (data.zIndex == 0) {
                        card.classList.add("highlight")
                    } else {
                        card.classList.remove("highlight")
                    }

                    card.style.zIndex = data.zIndex
                }
            }

            calcScale2(x) {
                let formula;

                if (x <= 0) {
                    formula = 1 - -1 / 5 * x

                    return formula
                } else if (x > 0) {
                    formula = 1 - 1 / 5 * x

                    return formula
                }
            }

            calcScale(x) {
                const formula = 1 - 1 / 5 * Math.pow(x, 2)

                if (formula <= 0) {
                    return 0
                } else {
                    return formula
                }
            }

            checkOrdering(card, x, xDist) {
                const original = parseInt(card.dataset.x)
                const rounded = Math.round(xDist)
                let newX = x

                if (x !== x + rounded) {
                    if (x + rounded > original) {
                        if (x + rounded > this.centerIndex) {

                            newX = ((x + rounded - 1) - this.centerIndex) - rounded + -this.centerIndex
                        }
                    } else if (x + rounded < original) {
                        if (x + rounded < -this.centerIndex) {

                            newX = ((x + rounded + 1) + this.centerIndex) - rounded + this.centerIndex
                        }
                    }

                    this.xScale[newX + rounded] = card;
                }

                const temp = -Math.abs(newX + rounded)

                this.updateCards(card, {
                    zIndex: temp
                })

                return newX;
            }

            moveCards(data) {
                let xDist;

                if (data != null) {
                    this.container.classList.remove("smooth-return")
                    xDist = data.x / 250;
                } else {


                    this.container.classList.add("smooth-return")
                    xDist = 0;

                    for (let x in this.xScale) {
                        this.updateCards(this.xScale[x], {
                            x: x,
                            zIndex: Math.abs(Math.abs(x) - this.centerIndex)
                        })
                    }
                }

                for (let i = 0; i < this.cards.length; i++) {
                    const x = this.checkOrdering(this.cards[i], parseInt(this.cards[i].dataset.x), xDist),
                        scale = this.calcScale(x + xDist),
                        scale2 = this.calcScale2(x + xDist),
                        leftPos = this.calcPos(x + xDist, scale2)


                    this.updateCards(this.cards[i], {
                        scale: scale,
                        leftPos: leftPos
                    })
                }
            }
        }

        const carousel = new CardCarousel(cardsContainer)
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            //------ Slider Begin
            const CaroS = document.querySelector('.Carousel-slider');
            const CaroSlider = new MicroSlider(CaroS, {
                indicators: true,
                indicatorText: ''
            });
            const hammer = new Hammer(CaroS);
            const CaroSTimer = 2000;
            let CaroAutoplay = setInterval(() => CaroSlider.next(), CaroSTimer);

            //------- Mouseenter Event
            CaroS.onmouseenter = function(e) {
                clearInterval(CaroAutoplay);
                console.log(e.type + ' mouse detected');
            }

            //----- Mouseleave Event
            CaroS.onmouseleave = function(e) {
                clearInterval(CaroAutoplay);
                CaroAutoplay = setInterval(() => CaroSlider.next(), CaroSTimer);
                console.log(e.type + ' mouse detected');
            }

            //----- Mouseclick Event
            CaroS.onclick = function(e) {
                clearInterval(CaroAutoplay);
                console.log(e.type + ' mouse detected');
            }

            //------ Gesture Tap Event
            hammer.on('tap', function(e) {
                clearInterval(CaroAutoplay);
                console.log(e.type + ' gesture detected');
            });

            //----- Gesture Swipe Event
            hammer.on('swipe', function(e) {
                clearInterval(CaroAutoplay);
                CaroAutoplay = setInterval(() => CaroSlider.next(), CaroSTimer);
                console.log(e.type + ' gesture detected');
            });

            let slideLink = document.querySelectorAll('.slider-item');
            if (slideLink && slideLink !== null && slideLink.length > 0) {
                slideLink.forEach(el => el.addEventListener('click', e => {
                    e.preventDefault();
                    let href = el.dataset.href;
                    let target = el.dataset.target;
                    if (href !== '#') window.open(href, target);
                }));
            }

            //---- Slider End

        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/micro-slider@1.0.9/dist/micro-slider.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php include "footer.php" ?>
</body>

</html>