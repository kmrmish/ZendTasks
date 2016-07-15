$(document).ready(function () {
    $("#col1,#col8").html("<img id = 'imgcol1' src = '/img/rook_white.png'>");
    $("#col2,#col7").html("<img id = 'imgcol1' src = '/img/knight_white.png'>");
    $("#col3,#col6").html("<img id = 'imgcol1' src = '/img/bishop_white.png'>");
    $("#col4").html("<img id = 'imgcol1' src = '/img/king_white.png'>");
    $("#col5").html("<img id = 'imgcol1' src = '/img/queen_white.png'>");

    $("#col57,#col64").html("<img id = 'imgcol1' src = '/img/rook_black.png'>");
    $("#col58,#col63").html("<img id = 'imgcol1' src = '/img/knight_black.png'>");
    $("#col59,#col62").html("<img id = 'imgcol1' src = '/img/bishop_black.png'>");
    $("#col61").html("<img id = 'imgcol1' src = '/img/queen_black.png'>");
    $("#col60").html("<img id = 'imgcol1' src = '/img/king_black.png'>");

    $("#col9,#col10,#col11,#col12,#col13,#col14,#col15,#col16").html("<img id = 'imgcol1' src = '/img/pawn_white.png'>");
    $("#col49,#col50,#col51,#col52,#col53,#col54,#col55,#col56").html("<img id = 'imgcol1' src = '/img/pawn_black.png'>");


    var selectedid = 'col';  //storing currently seleced box id...
    var selectedflag = 0;    //1 for selected 0 from deselected...
    var currentPossibleMoves = new Array();//storing all possible moves for current piece...
    var currentMoveSide = 'black';

    //selecting, deselecting and moving the piece on blackbox
    $(".whitebox").click(function () {
        //selecting the box.................
       
            var id = this.id;
            var img = $("#" + id).html();
            var box = parseInt(id.substring(3));
            //moving the chess piece
            if (selectedflag == 1 && selectedid != id)
            {
                var to = checkInCurrentPossibleMoves(box);
                if (to)
                {

                    moveChessPiece(id, selectedid);
                    if(currentMoveSide == "black"){
                        currentMoveSide = "white";
                    }else if(currentMoveSide == "white"){
                        currentMoveSide = "black";
                    }
                    hidePossibleMoves();
                    selectedflag = 0;
                    selectedid = 'col';
                }
            } else
            {
                
                //selecting the box and showing all possible moves	     
                    if (selectedflag == 0)
                    {
                        var piectTypeStr = getChessPieceType(this.id);
                        if(piectTypeStr.indexOf(currentMoveSide) > -1){
                            var img = $("#" + id).html();
                            if (img.indexOf("img") > -1)
                            {
                                $("#" + id).toggleClass("selectedWhite");
                                selectedflag = 1;
                                selectedid = id;
                                showPossibleMoves(id);
                            }
                        
                           
                        }

                    }
                    //deselecting the box and hiding all possible moves
                    else if (selectedid == id)
                    {
                        $("#" + id).toggleClass("selectedWhite");
                        selectedflag = 0;
                        selectedid = 'col';
                        hidePossibleMoves();
                    }
        
            }
            
    });

//selecting, deselecting and moving the piece on blackbox
    $(".blackbox").click(function () {
      
            var id = this.id
            var img = $("#" + id).html();
            var box = id.substring(3);  //getting box number

            //moving the chess piece
            if (selectedflag == 1 && selectedid != id)
            {
                var to = checkInCurrentPossibleMoves(box);
                if (to)
                {
                    moveChessPiece(id, selectedid);
                    if(currentMoveSide == "black"){
                        currentMoveSide = "white";
                    }else if(currentMoveSide == "white"){
                        currentMoveSide = "black";
                    }
                    hidePossibleMoves();
                    $("#" + selectedid).removeClass("selectedBlack");
                    selectedflag = 0;
                    selectedid = 'col';
                }
            } else
            {
                
                    //selecting the box and showing all possible moves
                    if (selectedflag == 0)
                    {
                        var piectTypeStr = getChessPieceType(this.id);
                        if(piectTypeStr.indexOf(currentMoveSide) > -1){
                            if (img.indexOf("img") > -1)
                            {
                                $("#" + id).toggleClass("selectedBlack");
                                selectedflag = 1;
                                selectedid = id;
                                showPossibleMoves(id);
                            }
                            
                         }
                    }
                    //deselecting the box and hiding all possible moves
                    else if (selectedid == id)
                    {
                        $("#" + id).toggleClass("selectedBlack");
                        selectedflag = 0;
                        selectedid = 'col';
                        hidePossibleMoves();
                    }
                    
            }
            
    });
});

function getChessPieceType(id){
    var img = $("#" + id).html();
    var chessPiece = getChessPiece(img);
    return chessPiece;
}

//getting the chess piece on selected box
function getChessPiece(img)
{
    if (img.search("pawn_white") != -1)
    {
        return "pawn_white";
    } else if (img.search("rook_white") != -1)
    {
        return "rook_white";
    } else if (img.search("knight_white") != -1)
    {
        return "knight_white";
    } else if (img.search("bishop_white") != -1)
    {
        return "bishop_white";
    } else if (img.search("king_white") != -1)
    {
        return "king_white";
    } else if (img.search("queen_white") != -1)
    {
        return "queen_white";
    } else if (img.search("pawn_black") != -1)
    {
        return "pawn_black";
    } else if (img.search("rook_black") != -1)
    {
        return "rook_black";
    } else if (img.search("knight_black") != -1)
    {
        return "knight_black";
    } else if (img.search("bishop_black") != -1)
    {
        return "bishop_black";
    } else if (img.search("king_black") != -1)
    {
        return "king_black";
    } else if (img.search("queen_black") != -1)
    {
        return "queen_black";
    }

}


// showing all possible moves for selected piece
function showPossibleMoves(id)
{
    var img = $("#" + id).html();
    var chessPiece = getChessPiece(img);

    if (chessPiece == "pawn_white" || chessPiece == "pawn_black")
    {
        currentPossibleMoves = showPawnMoves(id, chessPiece);

        for (var i = 0; i < currentPossibleMoves.length; i++)
        {
            var tempid = "col" + currentPossibleMoves[i];
            $("#" + tempid).addClass("selectPossibleMove");
        }
    } else if (chessPiece == "rook_white" || chessPiece == "rook_black")
    {
        currentPossibleMoves = showRookMoves(id, chessPiece);

        for (var i = 0; i < currentPossibleMoves.length; i++)
        {
            var tempid = "col" + currentPossibleMoves[i];
            $("#" + tempid).addClass("selectPossibleMove");
        }
    } else if (chessPiece == "knight_white" || chessPiece == "knight_black")
    {
        currentPossibleMoves = showKnightMoves(id, chessPiece);

        for (var i = 0; i < currentPossibleMoves.length; i++)
        {
            var tempid = "col" + currentPossibleMoves[i];
            $("#" + tempid).addClass("selectPossibleMove");
        }
    } else if (chessPiece == "bishop_white" || chessPiece == "bishop_black")
    {
        currentPossibleMoves = showBishopMoves(id, chessPiece);
        for (var i = 0; i < currentPossibleMoves.length; i++)
        {
            var tempid = "col" + currentPossibleMoves[i];
            $("#" + tempid).addClass("selectPossibleMove");
        }
    } else if (chessPiece == "queen_white" || chessPiece == "queen_black")
    {
        currentPossibleMoves = showQueenMoves(id, chessPiece);
        for (var i = 0; i < currentPossibleMoves.length; i++)
        {
            var tempid = "col" + currentPossibleMoves[i];
            $("#" + tempid).addClass("selectPossibleMove");
        }
    } else if (chessPiece == "king_white" || chessPiece == "king_black")
    {
        currentPossibleMoves = showKingMoves(id, chessPiece);
        for (var i = 0; i < currentPossibleMoves.length; i++)
        {
            var tempid = "col" + currentPossibleMoves[i];
            $("#" + tempid).addClass("selectPossibleMove");
        }
    }


}


//checking whether the destination box is possible move or not....
function checkInCurrentPossibleMoves(box)
{

    for (var i = 0; i < currentPossibleMoves.length; i++)
    {
        if (box == currentPossibleMoves[i])
            return true;
    }

}


//deselecting all possible moves for currently selected chess piece
function hidePossibleMoves()
{

    for (var i = 0; i < currentPossibleMoves.length; i++)
    {
        var tempid = "col" + currentPossibleMoves[i];
        $("#" + tempid).removeClass("selectPossibleMove");
    }

}



//finding all possible moves for a pown from a perticular box
function showPawnMoves(id, chessPiece)
{
    var Moves = new Array();
    var flag = 0;
    if (chessPiece == "pawn_white")//white pawn moves......................
    {
        var boxNumber = id.substring(3);


        var pathbox1 = parseInt(boxNumber) + 8;


        //for left kill move.....
        var pathbox1Left = pathbox1 - 1;
        var tempLeft = $("#col" + pathbox1Left).html();
        if (pathbox1Left % 8 != 0 && tempLeft.search("black") > -1)
        {
            Moves[flag++] = pathbox1Left;
        }

        //for right kill move....
        var pathbox1Right = pathbox1 + 1;
        var tempRight = $("#col" + pathbox1Right).html();
        if (pathbox1Right % 8 != 1 && tempRight.search("black") > -1)
        {
            Moves[flag++] = pathbox1Right;
        }

        //forword step......
        var temp = $("#col" + pathbox1).html();
        if (temp.search("img") == -1)
        {
            var forword1 = parseInt(boxNumber) + 8
            var forword1str = $("#col" + forword1).html();
            var forword2 = parseInt(boxNumber) + 16
            var forword2str = $("#col" + forword2).html();
            if (parseInt(boxNumber) > 16 && forword1str.search("img") == -1)
                Moves[flag++] = parseInt(boxNumber) + 8;
            else if (forword2str.search("img") == -1)
                Moves[flag++] = parseInt(boxNumber) + 16;
        }

    } else if (chessPiece == "pawn_black")//black pawn moves...................
    {
        var boxNumber = id.substring(3);
        var pathbox1 = parseInt(boxNumber) - 8;


        //for left kill move
        var pathbox1Left = pathbox1 - 1;
        var tempLeft = $("#col" + pathbox1Left).html();
        if (pathbox1Left % 8 != 0 && tempLeft.search("white") > -1)
        {
            Moves[flag++] = pathbox1Left;
        }

        //for right kill move
        var pathbox1Right = pathbox1 + 1;
        var tempRight = $("#col" + pathbox1Right).html();
        if (pathbox1Right % 8 != 1 && tempRight.search("white") > -1)
        {
            Moves[flag++] = pathbox1Right;
        }

        //forword step......
        var temp = $("#col" + pathbox1).html();
        if (temp.search("img") == -1)
        {
            var forword1 = parseInt(boxNumber) - 8
            var forword1str = $("#col" + forword1).html();
            var forword2 = parseInt(boxNumber) - 16
            var forword2str = $("#col" + forword2).html();
            if (parseInt(boxNumber) <= 48 && forword1str.search("img") == -1)
                Moves[flag++] = parseInt(boxNumber) - 8;
            else if (forword2str.search("img") == -1)
                Moves[flag++] = parseInt(boxNumber) - 16;
        }

    }

    return Moves;
}

//finding all possible moves for a rook from a perticular box
function showRookMoves(id, chessPiece)
{
    var Moves = new Array();
    var boxNumber = id.substring(3);

    //for vertical moves....
    var verticalMax = findVerticalMax(boxNumber);
    var verticalMin = findVerticalMin(boxNumber);
    var verticalRookMoves = new Array();
    verticalRookMoves = getVerticalRookMoves(verticalMin, verticalMax, boxNumber);


    //for horizintal moves........
    var horizontalMax = findHorizontalMax(boxNumber);
    var horizontalMin = findHorizontalMin(boxNumber);
    var horizontalRookMoves = new Array();
    horizontalRookMoves = getHorizontalRookMoves(horizontalMin, horizontalMax, boxNumber);

    //all rook moves
    Moves = verticalRookMoves.concat(horizontalRookMoves);
    return Moves;
}

//finding all possible moves for a knight from a perticular box
function showKnightMoves(id, chessPiece)
{
    var Moves = new Array();
    var flag = 0;
    var boxNumber = id.substring(3);


    //color variables............
    var oppositeColor = findOppositeColor(boxNumber);
    var sameColor = "white";
    if (oppositeColor == "white")
    {
        sameColor = "black";
    }

    //vertical downword direction......................
    var target1 = parseInt(boxNumber) + 16 + 1;

    if (target1 <= 64 && target1 >= 1)
    {
        var isOut1 = isKnightTargetOutOfTheBox(boxNumber, target1, 17);
        if (isOut1)
        {
            var target1str = $("#col" + target1).html();

            if (target1str.search(sameColor) == -1)
                Moves[flag++] = target1;
        }
    }

    var target2 = parseInt(boxNumber) + 16 - 1;
    var isOut2 = isKnightTargetOutOfTheBox(boxNumber, target2, 15);
    if (isOut2)
    {
        if (target2 <= 64 && target2 >= 1)
        {
            var target2str = $("#col" + target2).html();

            if (target2str.search(sameColor) == -1)
                Moves[flag++] = target2;
        }
    }

    //vertical upword direction...............
    var target3 = parseInt(boxNumber) - 16 + 1;


    var isOut3 = isKnightTargetOutOfTheBox(boxNumber, target3, -15);
    if (isOut3)
    {
        if (target3 <= 64 && target3 >= 1)
        {
            var target3str = $("#col" + target3).html();

            if (target3str.search(sameColor) == -1)
                Moves[flag++] = target3;
        }
    }

    var target4 = parseInt(boxNumber) - 16 - 1;
    var isOut4 = isKnightTargetOutOfTheBox(boxNumber, target4, -17);
    if (isOut4)
    {
        if (target4 <= 64 && target4 >= 1)
        {
            var target4str = $("#col" + target4).html();

            if (target4str.search(sameColor) == -1)
                Moves[flag++] = target4;
        }
    }



    //horizontal right direction.....................
    var target5 = parseInt(boxNumber) + 2 + 8;

    var isOut5 = isKnightTargetOutOfTheBox(boxNumber, target5, 10);
    if (isOut5)
    {
        if (target5 <= 64 && target5 >= 1)
        {
            var target5str = $("#col" + target5).html();

            if (target5str.search(sameColor) == -1)
                Moves[flag++] = target5;
        }
    }

    var target6 = parseInt(boxNumber) + 2 - 8;
    var isOut6 = isKnightTargetOutOfTheBox(boxNumber, target6, -6);
    if (isOut6)
    {
        if (target6 <= 64 && target6 >= 1)
        {
            var target6str = $("#col" + target6).html();

            if (target6str.search(sameColor) == -1)
                Moves[flag++] = target6;
        }
    }
    //horizontal left direction.....................
    var target7 = parseInt(boxNumber) - 2 + 8;
    var isOut7 = isKnightTargetOutOfTheBox(boxNumber, target7, 6);
    if (isOut7)
    {
        if (target7 <= 64 && target7 >= 1)
        {
            var target7str = $("#col" + target7).html();

            if (target7str.search(sameColor) == -1)
                Moves[flag++] = target7;
        }
    }

    var target8 = parseInt(boxNumber) - 2 - 8;
    var isOut8 = isKnightTargetOutOfTheBox(boxNumber, target8, -10);
    if (isOut8)
    {
        if (target8 <= 64 && target8 >= 1)
        {
            var target8str = $("#col" + target8).html();

            if (target8str.search(sameColor) == -1)
                Moves[flag++] = target8;
        }
    }


    return Moves;
}

//finding all possible moves for a bishop from a perticular box
function showBishopMoves(id, chessPiece)
{

    var Moves = new Array();
    var flag = 0;
    var boxNumber = id.substring(3);


    //color variables............
    var oppositeColor = findOppositeColor(boxNumber);
    var sameColor = "white";
    if (oppositeColor == "white")
    {
        sameColor = "black";
    }

    var backRightMoves = new Array();
    backRightMoves = getBishopBackRightMoves(boxNumber, sameColor, oppositeColor);

    var backLeftMoves = new Array();
    backLeftMoves = getBishopBackLeftMoves(boxNumber, sameColor, oppositeColor);


    var frontRightMoves = new Array();
    frontRightMoves = getBishopFrontRightMoves(boxNumber, sameColor, oppositeColor);

    var frontLeftMoves = new Array();
    frontLeftMoves = getBishopFrontLeftMoves(boxNumber, sameColor, oppositeColor);



    //alert("bishop moves");
    //Moves = verticalRookMoves.concat(horizontalRookMoves);
    Moves = frontLeftMoves;
    Moves = Moves.concat(frontRightMoves);
    Moves = Moves.concat(backRightMoves);
    Moves = Moves.concat(backLeftMoves);

    return Moves;
}

//finding all possible moves for a queen from a perticular box
function showQueenMoves(id, chessPiece)
{
    var rookMoves = new Array();
    rookMoves = showRookMoves(id, chessPiece);
    var bishopMoves = new Array();
    bishopMoves = showBishopMoves(id, chessPiece);

    var Moves = new Array();
    Moves = rookMoves.concat(bishopMoves);
    return Moves;

}
//finding all possible moves for a king from a perticular box
function showKingMoves(id, chessPiece)
{
    var Moves = new Array();
    var flag = 0;
    var boxNumber = id.substring(3);


    //color variables............
    var oppositeColor = findOppositeColor(boxNumber);
    var sameColor = "white";
    if (oppositeColor == "white")
    {
        sameColor = "black";
    }

    var up = parseInt(boxNumber) - 8;
    var upstr = $("#col" + up).html();
    if (parseInt(boxNumber) > 8 && upstr.search(sameColor) == -1)
        Moves[flag++] = up;

    var down = parseInt(boxNumber) + 8;
    var downstr = $("#col" + down).html();
    if (parseInt(boxNumber) < 57 && downstr.search(sameColor) == -1)
        Moves[flag++] = down;


    var left = parseInt(boxNumber) - 1;
    var leftstr = $("#col" + left).html();
    var leftmost = getLeftMost(parseInt(boxNumber));
    if (left >= leftmost && leftstr.search(sameColor) == -1)
        Moves[flag++] = left;

    var right = parseInt(boxNumber) + 1;
    var rightstr = $("#col" + right).html();
    var rightmost = getRightMost(parseInt(boxNumber));
    if (right <= rightmost && rightstr.search(sameColor) == -1)
        Moves[flag++] = right;

    var upleft = parseInt(boxNumber) - 9;
    var upleftstr = $("#col" + upleft).html();
    if (parseInt(boxNumber) - 8 >= 1)
    {
        var leftmost = getLeftMost(parseInt(boxNumber) - 8);
        if (upleft >= leftmost && upleftstr.search(sameColor) == -1)
            Moves[flag++] = upleft;
    }


    if (parseInt(boxNumber) - 8 >= 1)
    {
        var upright = parseInt(boxNumber) - 7;
        var uprightstr = $("#col" + upright).html();
        var rightmost = getRightMost(parseInt(boxNumber) - 8);
        if (upright <= rightmost && uprightstr.search(sameColor) == -1)
            Moves[flag++] = upright;
    }

    if (parseInt(boxNumber) + 8 <= 64)
    {
        var downleft = parseInt(boxNumber) + 7;
        var downleftstr = $("#col" + downleft).html();
        var leftmost = getLeftMost(parseInt(boxNumber) + 8);
        if (downleft >= leftmost && downleftstr.search(sameColor) == -1)
            Moves[flag++] = downleft;
    }

    if (parseInt(boxNumber) + 8 <= 64)
    {
        var downright = parseInt(boxNumber) + 9;
        var downrightstr = $("#col" + downright).html();
        var rightmost = getRightMost(parseInt(boxNumber) + 8);
        if (downright <= rightmost && downrightstr.search(sameColor) == -1)
            Moves[flag++] = downright;
    }

    return Moves;

}





//function to move chess piece from 'selectedid' box to 'id' box
function moveChessPiece(id, selectedid)
{
    $("#" + selectedid).removeClass("selectedWhite");
    $("#" + selectedid).removeClass("selectedBlack");
    var img = $("#" + selectedid).html();
    $("#" + selectedid).html('');
    $("#" + id).html(img);
}

//helper functions..........................................................

function findVerticalMin(boxNumber) //helper function for showRookMoves()
{
    var oppositeColor = findOppositeColor(boxNumber);
    var sameColor = "white";
    if (oppositeColor == "white")
    {
        sameColor = "black";
    }
    var i;
    var verticalMin = parseInt(boxNumber);
    for (i = parseInt(boxNumber) - 8; i >= 1; i = i - 8)
    {
        var temp = $("#col" + i).html();
        if (temp.search(sameColor) > -1)
        {
            verticalMin = i + 8;

            return verticalMin;
        } else if (temp.search(oppositeColor) > -1)
        {
            verticalMin = i;

            return verticalMin;
        }
    }
    verticalMin = i + 8;
    return verticalMin;

}

function findVerticalMax(boxNumber) //helper function for showRookMoves()
{

    var oppositeColor = findOppositeColor(boxNumber);
    var sameColor = "white";
    if (oppositeColor == "white")
    {
        sameColor = "black";
    }

    var i;
    var verticalMax = parseInt(boxNumber);
    for (i = parseInt(boxNumber) + 8; i <= 64; i = i + 8)
    {
        var temp = $("#col" + i).html();
        if (temp.search(sameColor) > -1)
        {
            verticalMax = i - 8;

            return verticalMax;
        } else if (temp.search(oppositeColor) > -1)
        {
            verticalMax = i;

            return verticalMax;
        }
    }
    verticalMax = i - 8;
    return verticalMax;

}

function findHorizontalMin(boxNumber)
{
    var oppositeColor = findOppositeColor(boxNumber);
    var sameColor = "white";
    if (oppositeColor == "white")
    {
        sameColor = "black";
    }
    var i;
    var horizontalMin;
    var q = parseInt(boxNumber) / 8;
    q = parseInt(q);
    if (parseInt(boxNumber) % 8 == 0)
        q--;
    var left = q * 8;
    left = parseInt(left);
    left++;

    for (i = parseInt(boxNumber) - 1; i >= left; i = i - 1)
    {
        var temp = $("#col" + i).html();
        if (temp.search(sameColor) > -1)
        {
            horizontalMin = i + 1;

            return horizontalMin;
        } else if (temp.search(oppositeColor) > -1)
        {
            horizontalMin = i;

            return horizontalMin;
        }
    }
    horizontalMin = i + 1;
    return horizontalMin;

}

function findHorizontalMax(boxNumber)
{
    var oppositeColor = findOppositeColor(boxNumber);
    var sameColor = "white";
    if (oppositeColor == "white")
        sameColor = "black";

    var i = parseInt(boxNumber);
    var horizontalMax;
    var q = parseInt(boxNumber) / 8;
    q = parseInt(q);
    if (parseInt(boxNumber) % 8 == 0)
    {
        return parseInt(boxNumber) - 1;
    }
    q++;
    var right = q * 8;
    right = parseInt(right);

    for (i = parseInt(boxNumber) + 1; i <= right; i = i + 1)
    {
        var temp = $("#col" + i).html();
        if (temp.search(sameColor) > -1)
        {
            horizontalMax = i - 1;

            return horizontalMax;
        } else if (temp.search(oppositeColor) > -1)
        {
            horizontalMax = i;

            return horizontalMax;
        }
    }

    horizontalMax = i - 1;
    return horizontalMax;
}

function getVerticalRookMoves(verticalMin, verticalMax, boxNumber)
{

    var Moves = new Array();
    var flag = 0;
    var i = 1;
    for (i = verticalMin; i <= verticalMax; i = i + 8)
    {
        if (i != parseInt(boxNumber))
        {
            Moves[flag] = i;
            flag++;
        }

    }
    return Moves;
}

function getHorizontalRookMoves(horizontalMin, horizontalMax, boxNumber)
{

    var Moves = new Array();
    var flag = 0;
    var i = 1;
    for (i = horizontalMin; i <= horizontalMax; i = i + 1)
    {
        if (i != parseInt(boxNumber))
        {
            Moves[flag] = i;
            flag++;

        }
    }
    return Moves;
}

function findOppositeColor(boxNumber)
{
    var box = $("#col" + boxNumber).html();
    var oppositeColor = "black";
    if (box.search("black") > -1)
    {
        oppositeColor = "white";
    }
    return oppositeColor;
}


function isKnightTargetOutOfTheBox(boxNumber, target, diff)
{
    if (diff == 15 || diff == 17)
    {
        var step1 = parseInt(boxNumber) + 8;
        var step2 = parseInt(boxNumber) + 16;
        var target = parseInt(target);
        if (step1 > 64)
            return false;
        if (step2 > 64)
            return false;
        if (target > 64)
            return false;

        var q = parseInt(step2) / 8;
        q = parseInt(q);
        var leftmost = q * 8 + 1;
        q++;
        var rightmost = q * 8;
        if (parseInt(step2) % 8 == 0)
        {
            rightmost = parseInt(step2);
            leftmost = parseInt(step2) - 7;
        }
        if (target < leftmost || target > rightmost)
            return false;
    } else if (diff == -15 || diff == -17)
    {
        var step1 = parseInt(boxNumber) - 8;
        var step2 = parseInt(boxNumber) - 16;
        var target = parseInt(target);
        if (step1 < 1)
            return false;
        if (step2 < 1)
            return false;
        if (target < 1)
            return false;

        var q = parseInt(step2) / 8;
        q = parseInt(q);
        var leftmost = q * 8 + 1;
        q++;
        var rightmost = q * 8;

        if (parseInt(step2) % 8 == 0)
        {
            rightmost = parseInt(step2);
            leftmost = parseInt(step2) - 7;
        }
        if (target < leftmost || target > rightmost)
            return false;
    } else if (diff == -6 || diff == 10)
    {


        var q = parseInt(boxNumber) / 8;
        q = parseInt(q);
        var leftmost = q * 8 + 1;
        q++;
        var rightmost = q * 8;

        if (parseInt(boxNumber) % 8 == 0)
        {
            rightmost = parseInt(boxNumber);
            leftmost = parseInt(boxNumber) - 7;
        }
        var step1 = parseInt(boxNumber) + 1;
        var step2 = parseInt(boxNumber) + 2;
        var target = parseInt(target);

        if (step1 > rightmost)
            return false;
        if (step2 > rightmost)
            return false;
        if (target < 1 || target > 64)
            return false;
    } else if (diff == -10 || diff == 6)
    {
        var q = parseInt(boxNumber) / 8;
        q = parseInt(q);
        var leftmost = q * 8 + 1;
        q++;
        var rightmost = q * 8;

        if (parseInt(boxNumber) % 8 == 0)
        {
            rightmost = parseInt(boxNumber);
            leftmost = parseInt(boxNumber) - 7;
        }
        var step1 = parseInt(boxNumber) - 1;
        var step2 = parseInt(boxNumber) - 2;
        var target = parseInt(target);
        if (step1 < leftmost)
            return false;
        if (step2 < leftmost)
            return false;
        if (target < 1 || target > 64)
            return false;
    }
    return true;

}


function getRightMost(box)
{
    if (parseInt(box) % 8 == 0)
        return parseInt(box);
    else
    {
        var q = parseInt(box) / 8;
        q = parseInt(q);
        q++;
        return q * 8;
    }

}

function getLeftMost(box)
{
    if (parseInt(box) / 8 == 1)
        return parseInt(box);
    else if (parseInt(box) / 8 == 0)
    {
        var q = parseInt(box) / 8;
        q = parseInt(q);
        q--;
        return q * 8 + 1;
    } else
    {
        var q = parseInt(box) / 8;
        q = parseInt(q);
        return q * 8 + 1;
    }

}

function getBishopBackRightMoves(boxNumber, sameColor, oppositeColor)
{

    var moves = new Array();
    var flag = 0;
    var i = 0;
    if (parseInt(boxNumber) % 8 == 0)
        return moves;
    for (i = parseInt(boxNumber) - 7; i >= 1; i = i - 7)
    {

        var box = $("#col" + i).html();
        if (box.search(sameColor) > -1)
            return moves;
        else if (box.search(oppositeColor) > -1)
        {
            moves[flag++] = i;
            return moves;
        }
        var rightmost = getRightMost(i);
        if (i == rightmost)
        {
            moves[flag++] = i;
            return moves;
        }
        moves[flag++] = i;
    }
    return moves;
}

function getBishopBackLeftMoves(boxNumber, sameColor, oppositeColor)
{

    var moves = new Array();
    var flag = 0;
    var i = 0;
    if (parseInt(boxNumber) % 8 == 1)
        return moves;
    for (i = parseInt(boxNumber) - 9; i >= 1; i = i - 9)
    {

        var box = $("#col" + i).html();
        if (box.search(sameColor) > -1)
            return moves;
        else if (box.search(oppositeColor) > -1)
        {
            moves[flag++] = i;
            return moves;
        }
        var leftmost = getLeftMost(i);

        if (i == leftmost)
        {
            moves[flag++] = i;
            return moves;
        }
        moves[flag++] = i;
    }
    return moves;
}



function getBishopFrontRightMoves(boxNumber, sameColor, oppositeColor)
{

    var moves = new Array();
    var flag = 0;
    var i = 0;
    if (parseInt(boxNumber) % 8 == 0 || (parseInt(boxNumber) >= 57 && parseInt(boxNumber) <= 64))
        return moves;

    for (i = parseInt(boxNumber) + 9; i <= 64; i = i + 9)
    {
        var box = $("#col" + i).html();
        if (box.search(sameColor) > -1)
            return moves;
        else if (box.search(oppositeColor) > -1)
        {
            moves[flag++] = i;
            return moves;
        }
        var rightmost = getRightMost(i);
        // alert(leftmost);
        if (i == rightmost)
        {
            moves[flag++] = parseInt(i);

            return moves;
        }
        moves[flag++] = parseInt(i);
    }

    return moves;
}

function getBishopFrontLeftMoves(boxNumber, sameColor, oppositeColor)
{

    var moves = new Array();
    var flag = 0;
    var i = 0;
    if (parseInt(boxNumber) % 8 == 1 || (parseInt(boxNumber) >= 57 && parseInt(boxNumber) <= 64))
        return moves;

    for (i = parseInt(boxNumber) + 7; i <= 64; i = i + 7)
    {
        var box = $("#col" + i).html();
        if (box.search(sameColor) > -1)
            return moves;
        else if (box.search(oppositeColor) > -1)
        {
            moves[flag++] = i;
            return moves;
        }
        var leftmost = getLeftMost(i);
        // alert(leftmost);
        if (i == leftmost)
        {
            moves[flag++] = parseInt(i);
            //alert(moves);
            return moves;
        }
        moves[flag++] = parseInt(i);
    }

    return moves;
}
