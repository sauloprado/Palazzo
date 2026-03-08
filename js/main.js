$(function() {
    var _center = {
        width: 800,
        height: 460,
        marginLeft: 0,
        marginTop: 0,
        marginRight: 0
    };
    var _left = {
        width: 350,
        height: 220,
        marginLeft: 0,
        marginTop: 125,
        marginRight: -150
    };
    var _right = {
        width: 350,
        height: 220,
        marginLeft: -150,
        marginTop: 125,
        marginRight: 0
    };
    var _outLeft = {
        width: 150,
        height: 100,
        marginLeft: 150,
        marginTop: 200,
        marginRight: -200
    };
    var _outRight = {
        width: 150,
        height: 100,
        marginLeft: -200,
        marginTop: 200,
        marginRight: 50
    };
    $('#carousel').carouFredSel({
        width: 1200,
        height: 460,
        align: false,
        items: {
            visible: 3,
            width: 100
        },
        scroll: {
            items: 1,
            duration: 800,
            onBefore: function( data ) {
                data.items.old.eq( 0 ).animate(_outLeft);
                data.items.visible.eq( 0 ).animate(_left);
                data.items.visible.eq( 1 ).animate(_center);
                data.items.visible.eq( 2 ).animate(_right).css({ zIndex: 1 });
                data.items.visible.eq( 2 ).next().css(_outRight).css({ zIndex: 0 });

                setTimeout(function() {
                    data.items.old.eq( 0 ).css({ zIndex: 1 });
                    data.items.visible.eq( 0 ).css({ zIndex: 2 });
                    data.items.visible.eq( 1 ).css({ zIndex: 3 });
                    data.items.visible.eq( 2 ).css({ zIndex: 2 });
                }, 200);
            }
        }
    });
    $('#carousel').children().eq( 0 ).css(_left).css({ zIndex: 2 });
    $('#carousel').children().eq( 1 ).css(_center).css({ zIndex: 3 });
    $('#carousel').children().eq( 2 ).css(_right).css({ zIndex: 2 });
    $('#carousel').children().eq( 3 ).css(_outRight).css({ zIndex: 1 });
});