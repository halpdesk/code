config = {
    xdim: 14,
    ydim: 14
}

walker = {

    movements: [],
    xpos: config.xdim/2,
    ypos: config.ydim/2,

    getId: function() {
        return this.xpos + "," + this.ypos;
    },
    getElement: function() {
        return document.getElementById(this.getId());
    },
    moveLeft: function() {
        var currentElement = this.getElement();
        this.xpos--;
        var nextElement = this.getElement();
        nextElement.className = nextElement.className += " walker";
        currentElement.className = currentElement.className.replace("walker", "wasHere");
    },
    moveRight: function() {
        var currentElement = this.getElement();
        this.xpos++;
        var nextElement = this.getElement();
        nextElement.className = nextElement.className += " walker";
        currentElement.className = currentElement.className.replace("walker", "wasHere");
    },
    moveUp: function() {
        var currentElement = this.getElement();
        this.ypos--;
        var nextElement = this.getElement();
        nextElement.className = nextElement.className += " walker";
        currentElement.className = currentElement.className.replace("walker", "wasHere");
    },
    moveDown: function() {
        var currentElement = this.getElement();
        this.ypos++;
        var nextElement = this.getElement();
        nextElement.className = nextElement.className += " walker";
        currentElement.className = currentElement.className.replace("walker", "wasHere");
    }
}

window.onload = function() {
    console.log("Random walker site loaded");
    var area = document.getElementById("area");
    var table = document.createElement("table");
    area.appendChild(table);
    for (i = 1; i < config.ydim; i++)
    {
        var tr = document.createElement("tr");
        for (j = 1; j < config.xdim; j++)
        {
            var td = document.createElement("td");
            td.id = j + "," + i;

            if ((i > 1 && i < config.ydim-1 && (j == 2 || j == config.xdim-2)) ||
                (j > 1 && j < config.xdim-1 && (i == 2 || i == config.ydim-2)))
            {
                td.className = "wall";
                td.innerHTML = ":";
            }

            if (i == config.ydim/2 && j == config.xdim/2)
            {
                td.className = "start walker";
                td.innerHTML = "S";
            }

            tr.appendChild(td);
        }
        table.appendChild(tr);
    }

    form = document.getElementById("form");
    if(form.addEventListener){
        form.addEventListener("submit", function(e) {
            e.preventDefault();
            var input = form.elements["walkstring"].value;
            walker.movements = JSON.parse(input);

            i = 0;
            var interval = setInterval(function() {
                var move = walker.movements[i];
                //console.log(i + ":" + move);
                switch (move) {
                    case "l":
                        walker.moveLeft();
                        break;
                    case "r":
                        walker.moveRight();
                        break;
                    case "u":
                        walker.moveUp();
                        break;
                    case "d":
                        walker.moveDown();
                        break;
                }
                if (i > walker.movements.length)
                    clearInterval(interval);
                i++;
            }, 100);

        }, false);
    }
}
