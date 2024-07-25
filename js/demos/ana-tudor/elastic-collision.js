import pauseAnimControl from '../../modules/pause-anim-control.js';

Object.getOwnPropertyNames(Math).map(function (p) {
    window[p] = Math[p];
});

if (!hypot) {
    var hypot = function (x, y) {
        return sqrt(pow(x, 2) + pow(y, 2));
    };
}

var rand = function (max, min, is_int) {
    var max = (max - 1 || 0) + 1,
        min = min || 0,
        gen = min + (max - min) * random();

    return is_int ? round(gen) : gen;
};

var randSign = function (k) {
    return random() < (k || 0.5) ? -1 : 1;
};

var σ = function (n) {
    return n / abs(n);
};

var μ = function (values, weights) {
    var n = min(values.length, weights.length),
        num = 0,
        den = 0;

    for (var i = 0; i < n; i++) {
        num += weights[i] * values[i];
        den += weights[i];
    }

    return num / den;
};

var N_BALLS = 32,
    EXPLAIN_MODE = false,
    balls = [],
    c = document.querySelector('canvas'),
    w,
    h,
    ctx = c.getContext('2d'),
    r_id = null,
    running = true;

var Segment = function (p1, p2) {
    this.p1 = p1 || null;
    this.p2 = p2 || null;
    this.α = null;

    this.init = function () {
        if (!this.p1) {
            this.p1 = {
                x: rand(w, 0, 1),
                y: rand(h, 0, 1),
            };
        }

        if (!this.p2) {
            this.p2 = {
                x: rand(w, 0, 1),
                y: rand(h, 0, 1),
            };
        }

        this.α = atan2(this.p2.y - this.p1.y, this.p2.x - this.p1.x);
    };

    this.init();
};

var Ball = function (hue, r, o, v) {
    var k = EXPLAIN_MODE ? 4 : 1,
        l = (9 - k) * 10;

    this.hue = hue || rand(360, 0, 1);
    this.c = 'hsl(' + this.hue + ',100%,' + l + '%)';

    this.r = r || rand(k * 32, k * 8, 1);

    this.o = o || null;

    this.init = function () {
        if (!this.o) {
            this.o = {
                x: rand(w - this.r, this.r, 1),
                y: rand(h - this.r, this.r, 1),
            };
        }

        if (!this.v) {
            this.v = {
                x: randSign() * rand(sqrt(k) * 4, k),
                y: randSign() * rand(sqrt(k) * 4, k),
            };
        }
    };

    this.handleWallHits = function (dir, lim, f) {
        var cond = f === 'up' ? this.o[dir] > lim : this.o[dir] < lim;

        if (cond) {
            this.o[dir] = lim;
            this.v[dir] *= -1;
        }
    };

    this.keepInBounds = function () {
        this.handleWallHits('x', this.r, 'low');
        this.handleWallHits('x', w - this.r, 'up');
        this.handleWallHits('y', this.r, 'low');
        this.handleWallHits('y', h - this.r, 'up');
    };

    this.move = function () {
        this.o.x += this.v.x;
        this.o.y += this.v.y;

        this.keepInBounds();
    };

    this.distanceTo = function (p) {
        return hypot(this.o.x - p.x, this.o.y - p.y);
    };

    this.collidesWith = function (b) {
        return this.distanceTo(b.o) < this.r + b.r;
    };

    this.handleBallHit = function (b, ctxt) {
        var θ1,
            θ2,
            /* the normal segment */
            ns = new Segment(this.o, b.o),
            /* contact point */
            cp = {
                x: μ([this.o.x, b.o.x], [b.r, this.r]),
                y: μ([this.o.y, b.o.y], [b.r, this.r]),
            };

        this.cs = {
            x: σ(cp.x - this.o.x),
            y: σ(cp.y - this.o.y),
        };
        b.cs = {
            x: σ(cp.x - b.o.x),
            y: σ(cp.y - b.o.y),
        };

        this.o = {
            x: cp.x - this.cs.x * this.r * abs(cos(ns.α)),
            y: cp.y - this.cs.y * this.r * abs(sin(ns.α)),
        };
        b.o = {
            x: cp.x - b.cs.x * b.r * abs(cos(ns.α)),
            y: cp.y - b.cs.y * b.r * abs(sin(ns.α)),
        };

        if (EXPLAIN_MODE) {
            ctxt.clearRect(0, 0, w, h);
            this.draw(ctxt);
            b.draw(ctxt);

            this.connect(b, ctxt);
        }

        this.v.α = atan2(this.v.y, this.v.x);
        b.v.α = atan2(b.v.y, b.v.x);

        this.v.val = hypot(this.v.y, this.v.x);
        b.v.val = hypot(b.v.y, b.v.x);

        θ1 = ns.α - this.v.α;
        θ2 = ns.α - b.v.α;

        this.v.α -= PI - 2 * θ1;
        b.v.α -= PI - 2 * θ2;

        this.v.x = this.v.val * cos(this.v.α);
        this.v.y = this.v.val * sin(this.v.α);

        b.v.x = b.v.val * cos(b.v.α);
        b.v.y = b.v.val * sin(b.v.α);

        if (EXPLAIN_MODE) {
            ctxt.setLineDash([0]);
            this.drawV(ctxt, 'gold');
            b.drawV(ctxt, 'blue');

            running = false;
            cancelAnimationFrame(r_id);
        }
    };

    this.connect = function (b, ctxt) {
        ctxt.strokeStyle = '#fff';
        ctxt.setLineDash([5]);

        ctxt.beginPath();
        ctxt.moveTo(this.o.x, this.o.y);
        ctxt.lineTo(b.o.x, b.o.y);
        ctxt.closePath();
        ctxt.stroke();
    };

    this.drawV = function (ctxt, lc) {
        var m = 32;

        ctxt.strokeStyle = lc || this.c;

        ctxt.beginPath();
        ctxt.moveTo(this.o.x, this.o.y);
        ctxt.lineTo(this.o.x + m * this.v.x, this.o.y + m * this.v.y);
        ctxt.closePath();
        ctxt.stroke();
    };

    this.draw = function (ctxt) {
        ctxt.strokeStyle = this.c;

        ctxt.beginPath();
        ctxt.arc(this.o.x, this.o.y, this.r, 0, 2 * PI);
        ctxt.closePath();
        ctxt.stroke();

        if (EXPLAIN_MODE) {
            this.drawV(ctxt);
        }
    };

    this.init();
};

var init = function () {
    var s = getComputedStyle(c),
        hue;

    w = c.width = ~~s.width.split('px')[0];
    h = c.height = ~~s.height.split('px')[0];

    if (r_id) {
        cancelAnimationFrame(r_id);
        r_id = null;
    }

    balls = [];

    ctx.lineWidth = 3;

    if (EXPLAIN_MODE) {
        N_BALLS = 2;
        running = true;
    }

    for (var i = 0; i < N_BALLS; i++) {
        hue = EXPLAIN_MODE ? i * 169 + 1 : null;
        balls.push(new Ball(hue));
    }

    handleCollisions();

    draw();
};

var handleCollisions = function () {
    var collis = false;

    do {
        for (var i = 0; i < N_BALLS; i++) {
            for (var j = 0; j < i; j++) {
                if (balls[i].collidesWith(balls[j])) {
                    balls[i].handleBallHit(balls[j], ctx);
                }
            }
        }
    } while (collis);
};

var draw = function () {
    ctx.clearRect(0, 0, w, h);

    for (var i = 0; i < N_BALLS; i++) {
        ctx.setLineDash([0]);
        balls[i].draw(ctx);
        balls[i].move();
        handleCollisions();
    }

    if (!EXPLAIN_MODE || running) {
        r_id = pauseAnimControl.requestAnimationFrame(draw);
    }
};

setTimeout(function () {
    init();

    addEventListener('resize', init, false);
    c.addEventListener('dblclick', init, false);
    addEventListener(
        'keydown',
        function (e) {
            if (e.keyCode == 13) {
                //EXPLAIN_MODE = !EXPLAIN_MODE;
                //init();
            }
        },
        false
    );
}, 15);
