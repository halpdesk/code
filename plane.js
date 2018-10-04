const dimensions = 100;

plane = {
    dimensions: dimensions,
    coord: [],
    create: function()
    {
        var plane   = document.getElementById("plane");
        var height  = plane.clientHeight;
        var width   = plane.clientWidth;
        var pixelWidth  = Math.floor(width/this.dimensions);
        var pixelHeight = Math.floor(height/this.dimensions);

        for (i = 0; i < this.dimensions; i++) {
            this.coord[i] = [];
            for (j = 0; j < this.dimensions; j++) {

                // create coordinates
                this.coord[i][j] = undefined;

                // create divs
                var x = j+1, y = this.dimensions-i;
                var div = document.createElement("div");
                div.dataset.x = x;
                div.dataset.y = y;
                div.style.width = pixelWidth;
                div.style.height = pixelHeight;
                div.className = "pixel";
                plane.appendChild(div);
            }
        }
    },
    update: function()
    {
        for (i in this.coord) {
            for (j in this.coord) {
                if (this.coord[i][j] instanceof Pixel) {
                    var pixel = this.coord[i][j];
                    var div = document.querySelectorAll("div[data-x='"+ pixel.pos.x +"'][data-y='"+ pixel.pos.y +"']")[0];
                    div.style.background = pixel.color;
                }
            }
        }
    }
}


Pixel = function(data) {
    this.pos        = new Position(data.pos);
    this.color      = data.color;
    this.f          = data.f;
}
Position = function(data) {
    this.x      = data.x;
    this.y      = data.y;
}
pxlr = {
    pixels: [],
    addPixel: function(pixel)
    {
        if (!(pixel instanceof Pixel))
            throw new Error("not instance of pixel");

        if (!plane.coord.hasOwnProperty(pixel.pos.x) || !plane.coord[pixel.pos.x].hasOwnProperty(pixel.pos.y))
            throw new Error("coordinates outside plane");

        plane.coord[pixel.pos.x][pixel.pos.y] = pixel;
        var div = document.querySelectorAll("div[data-x='"+ pixel.pos.x +"'][data-y='"+ pixel.pos.y +"']")[0];
        div.style.background = pixel.color;
    },
    updatePixel: function(pixel, pos)
    {
        var newPixel = new Pixel({"pos": pos, "color": pixel.color, "f": pixel.f})
        this.addPixel(newPixel);
        this.removePixel(pixel);
        return newPixel;
    },
    removePixel: function(pixel)
    {
        var color = pixel.color;
        var i = 1;
        var div = document.querySelectorAll("div[data-x='"+ pixel.pos.x +"'][data-y='"+ pixel.pos.y +"']")[0];
        var interval = setInterval(function() {
            var opactiy = 1/(i*i);
            div.style.opacity = opactiy;
            i++;
            if (i > 2) {
                clearInterval(interval);
                //div.style.opacity = 1;
                //div.style.background = "none";
                //plane.coord[pixel.pos.x][pixel.pos.y] = undefined;
            }
        }, 100);
    },
    getNextPos: function(pixel)
    {
        if (!(pixel instanceof Pixel))
            throw new Error("not instance of pixel");

        var x = pixel.pos.x + 1;
        var y = pixel.f + pixel.pos.y;
        var pos = new Position({"x": x, "y": y});
        return pos;
    }
}

window.onload = function() {
    try
    {
        plane.create();
        var pixels = [
            //new Pixel({"pos": {"x":1, "y":30}, "color":"red", "f": -1}),
            new Pixel({"pos": {"x":1, "y":80}, "color":"hotpink", "f": -1}),
            new Pixel({"pos": {"x":1, "y":50}, "color":"darkkhaki", "f": 0}),
            new Pixel({"pos": {"x":1, "y":25}, "color":"blue", "f": 3})
        ];
        for (n = 0; n < pixels.length; n++) {
            pxlr.addPixel(pixels[n]);
        }

        var tick = 0;
        var interal = setInterval(function() {
            for (n = 0; n < pixels.length; n++) {
                pixels[n] = pxlr.updatePixel(pixels[n], pxlr.getNextPos(pixels[n]));
            }
            tick++;
            if (tick > 80)
                clearInterval(interal);
        }, 5);

    }
    catch (e)
    {
        console.log(e);
    }

}
