// 日期函数


// 柱状图
function myoptionbar(d1,c1,t1) {

    return  {
        tooltip: {
            trigger: 'item',
            axisPointer: {
                type: 'cross',
                label: {
                    backgroundColor: '#6a7985'
                }
            }
        },
        xAxis: {
            type: 'category',
            data: t1,
            axisLine:{
                lineStyle:{
                    color:'white',
                    // width:2
                }
            }
        },
        yAxis: {
            type: 'value',
            axisLine:{
                lineStyle:{
                    color:'yellow',
                    // width:2
                }
            },splitLine: {
                lineStyle: {
                    color: "#888"
                }
            }
        },
        grid:{
            top:30,
            left:80,// 调整这个属性
            right:50,
            bottom:20,
        },
        series: [
            {
                data: d1,
                type: 'bar',
                itemStyle: {
                    color: function(params) {
                        //注意，如果颜色太少的话，后面颜色不会自动循环，最好多定义几个颜色
                        var colorList = c1;
                        return colorList[params.dataIndex]
                    },
                    label: {
                        show: true, //开启显示数值
                        position: 'top', //数值在上方显示
                        textStyle: {  //数值样式
                            color: '#D1DBFF',   //字体颜色
                            fontSize: 14  //字体大小
                        }
                    }
                },
            }
        ]

    };
}
//折线图
function myoptionline(d1,d2,t1,t2,x1) {
    return {
        tooltip: {
            trigger: 'item',
            axisPointer: {
                type: 'cross',
                label: {
                    backgroundColor: '#6a7985'
                }
            }
        },
        legend: {
            textStyle: {
                // fontSize: '20',
                color: '#eee'
            },
            data: [t1, t2]
        },
        grid: {
            left: '5%',
            right: '25',
            bottom: '3%',
            top:'35',
            containLabel: true
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: x1
            ,axisLine:{
                lineStyle:{
                    color:'white',
                    // width:2
                }
            },
        },
        yAxis: {
            type: 'value',
            axisLine:{
                lineStyle:{
                    color:'yellow',
                    // width:2
                }
            },
        },
        series: [
            {
                name: t1,
                type: 'line',
                // stack: 'Total',
                data: d1,
                itemStyle : {
                    normal: {
                        lineStyle: {
                            color: '#293fff'
                        }
                    }
                },
            },
            {
                name: t2,
                type: 'line',
                stack: 'Total',
                data: d2,
                itemStyle : {
                    normal:{
                        lineStyle:{
                            color:'#ff0000'
                        }
                    }

                },
            }
        ]
    };
}


//环形饼状图
function myoptionpie(title,vt1,vt2,v1,v2){
    return {
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b}: {c} ({d}%)'
        },
        series: [
            {
                name: title,
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: false,
                color: [ 'rgba(231,101,26,0.9)',
                    {
                        colorStops: [
                            {
                                offset: 0,
                                color: '#229dfe'
                            },
                            {
                                offset: 0.5,
                                color: '#6bdafe'
                            },
                            {
                                offset: 1,
                                color: '#49c3e3'
                            }
                        ]
                    },

                ],
                itemStyle: {
                    borderRadius: 8,
                    borderColor: '#fff',
                    borderWidth: 1
                },
                label: {
                    show: false,
                    position: 'center'
                },
                data: [
                    {
                        value: v1,
                        name: vt1,
                        label: {
                            show: true,
                            fontSize: '100%',
                            fontWeight: 'bold',
                            formatter: '{b}: {c}个\n \n 占比{d}%',
                            color: '#E7651A'
                        }
                    },
                    { value: v2, name: vt2 }
                ]
            }
        ]
    };

}


//横向柱状图
function myoptionbary(v1,v2,v3,d,t1,yle='1%') {
    return {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        legend: {
            y:yle,
            textStyle: {
                // fontSize: '20',
                color: '#eee',

            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: {
            type: 'value',
            // axisLine:{
            // lineStyle:{
            //     color:'white',
            //     // width:2
            // }
            // },

            // boundaryGap: [0, 0.01]
        },
        yAxis: {
            type: 'category',
            axisLine:{
                lineStyle:{
                    color:'yellow',
                    // width:2
                }
            },
            data: t1
        },
        series: [
            {
                name: d[0],
                type: 'bar',
                data: v1,
                label: {
                    show: true, //开启显示数值
                    position: 'right', //数值在上方显示
                    textStyle: {  //数值样式
                        color: 'yellow',   //字体颜色
                        fontSize: 14  //字体大小
                    }
                }
            },
            {
                name: d[1],
                type: 'bar',
                data: v2,
                label: {
                    show: true, //开启显示数值
                    position: 'right', //数值在上方显示
                    textStyle: {  //数值样式
                        color: 'yellow',   //字体颜色
                        fontSize: 14  //字体大小
                    }
                }
            },
            {
                name: d[2],
                type: 'bar',
                data: v3,
                label: {
                    show: true, //开启显示数值
                    position: 'right', //数值在上方显示
                    textStyle: {  //数值样式
                        color: 'yellow',   //字体颜色
                        fontSize: 14  //字体大小
                    }
                }
            },
        ]
    };

}

//环形饼状图带引导线
function myoptionpie3(t1,d) {
    return {
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b} : {c} ({d}%)'
        },
        legend: {
            icon: "circle",
            //icon形状  类型包括 circle，rect ，roundRect，triangle，diamond，pin，arrow，none,
            itemWidth: 15,  // 设置icon宽度
            itemHeight: 15, // 设置icon高度
            itemGap: 40, // 设置间距
            top: 'center',//竖直位置
            left: '8%',//水平位置
            // x: 50,//水平位置
            // y: 200,//竖直位置
            orient: "vertical",//设置显示顺序，默认水平（水平，竖直）
            textStyle: {
                color: "#fff"
            },
        },
        series: [
            {
                name: t1,
                type: 'pie',
                radius: ['40%', '70%'],
                center: ['60%', '50%'],
                avoidLabelOverlap: false,
                itemStyle: {
                    borderRadius: 10,
                    borderColor: '#fff',
                    borderWidth: 2
                },
                label:{
                    color:'#Fff'
                    // ,formatter: '{b} : {c} ({d}%)'
                }, labelLine: {
                    length: 13,
                    length2: 5,
                },
                data:d,
            }
        ]
    };
}

//环形饼状图带标题
function myoptionpie4(t1,d,title,pc1='60%') {
    return {
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b} : {c} ({d}%)'
        },
        title: {
            text: title,
            // top: 'center',
            left: '50%',
            textStyle:{
                //文字颜色
                color:'yellow',
                //字体风格,'normal','italic','oblique'
                fontStyle:'normal',
                //字体粗细 'normal','bold','bolder','lighter',100 | 200 | 300 | 400...
                fontWeight:'bold',
                //字体大小
                fontSize:22
            }
        },
        series: [
            {
                name: t1,
                type: 'pie',
                radius: ['40%', '70%'],
                center: [pc1, '50%'],
                avoidLabelOverlap: false,
                itemStyle: {
                    borderRadius: 7,
                    borderColor: '#fff',
                    borderWidth: 1
                },
                label:{
                    color:'#Fff'
                    ,formatter: '{b} \n {c} 个({d}%)'
                },
                labelLine: {
                    length: 13,
                    length2: 5,
                    maxSurfaceAngle: 80,
                    lineStyle: {            // 视觉引导线的样式
                        type:'solid',
                        width:2

                    }
                },
                data:d,

            }
        ]
    };
}

//环形饼状图竖向legend带引导线
function myoptionpie5(t1,d,pl1='5%',pc1='60%') {
    return {
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b} : {c} ({d}%)'
        },
        title: {
            text: '国民经济分类',
            // top: 'center',
            left: '60%',
            textStyle:{
                //文字颜色
                color:'yellow',
                //字体风格,'normal','italic','oblique'
                fontStyle:'normal',
                //字体粗细 'normal','bold','bolder','lighter',100 | 200 | 300 | 400...
                fontWeight:'bold',
                //字体大小
                fontSize:22
            }
        },
        legend: {
            icon: "circle",
            top: 'center',//竖直位置
            left: pl1,//水平位置
            orient: "vertical",//设置显示顺序，默认水平（水平，竖直）
            formatter:function(name){  //该函数用于设置图例显示后的百分比

                var value;
                // debugger;
                for (let i = 0; i < d.length; i++) {
                    if (d[i].name == name)value = d[i].value;
                }
                return `${name}：${value}`;  //返回出图例所显示的内容是名称+百分比
            },
            textStyle: {
                color: "#fff"
            },
        },
        series: [
            {
                name: t1,
                type: 'pie',
                radius: ['40%', '70%'],
                center: [pc1, '50%'],
                avoidLabelOverlap: false,
                itemStyle: {
                    borderRadius: 7,
                    borderColor: '#fff',
                    borderWidth: 1
                },
                label:{
                    color:'#Fff'
                    ,formatter: '{b} \n {c} 个({d}%)'
                },
                labelLine: {
                    length: 15,
                    length2: 5,
                    maxSurfaceAngle: 80,
                    lineStyle: {            // 视觉引导线的样式
                        type:'solid',
                        width:2

                    }
                },
                data:d,

            }
        ]
    };
}

//环形饼状图横向legend带引导线
function myoptionpie6(t1,d,pc1='60%') {
    return {
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b} : {c} ({d}%)'
        },
        legend: {
            icon: "circle",
            //icon形状  类型包括 circle，rect ，roundRect，triangle，diamond，pin，arrow，none,
            itemWidth: 17,  // 设置icon宽度
            itemHeight: 17, // 设置icon高度
            itemGap: 40, // 设置间距
            textStyle: {
                color: "#fff",
                fontSize:20
            },
        },
        series: [
            {
                name: t1,
                type: 'pie',
                radius: ['40%', '70%'],
                // center: [pc1, '50%'],
                avoidLabelOverlap: false,
                itemStyle: {
                    borderRadius: 10,
                    borderColor: '#fff',
                    borderWidth: 2
                },
                label:{
                    color:'#Fff'
                    ,fontSize:19
                    ,formatter: '{b} : {c} ({d}%)'
                }, labelLine: {
                    length: 15,
                    length2: 6,
                },
                data:d,
            }
        ]
    };
}
//环形饼状图
function myoptionpie7(title, vt1, vt2, v1, v2, rate) {
    return {
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b}: {c}'
        },
        title: {
            text: '同比',
            subtext: rate + "%",
            left:'center',
            top:'25%',
            // left: '20%',
            // top: '20%',
            textStyle: {
                fontSize: '14',
                color: 'white',
            },
            subtextStyle: {
                fontSize: '18',
                fontWeight: '600',
                color: 'yellow'
            }
        },

        series: [
            {
                name: title,
                type: 'pie',
                radius: ['50%', '70%'],
                center: ['50%', '40%'], // 默认情况下饼图居中，这里也可以调整来间接影响留白

                avoidLabelOverlap: false,
                color: [
                    {
                        colorStops: [
                            { offset: 0, color: '#71ae46' },
                            { offset: 0.5, color: '#96b744' },
                            { offset: 1, color: '#c4cc38' }
                        ]
                    },
                    {
                        colorStops: [
                            { offset: 0, color: '#229dfe' },
                            { offset: 0.5, color: '#6bdafe' },
                            { offset: 1, color: '#49c3e3' }
                        ]
                    }
                ],
                itemStyle: {
                    // borderRadius, borderColor, borderWidth 等样式如果需要可以添加
                },
                label: {
                    show: false,
                    position: 'center'
                },
                data: [
                    { value: v1, name: vt1 },
                    { value: v2, name: vt2 }
                ]
            }
        ]
    };
}

//竖向柱状图，对比
function myoptionbary2(v1,v2,v3,d1,d2,c1,yle='bottom') {
    return {
        tooltip: {
            trigger: 'axis',
        },
        legend: {
            y:yle,
            textStyle: {
                // fontSize: '20',
                color: '#eee',

            }
        },
        grid: {
            left: '3%',
            right: '4%',
            top: '15%',
            bottom:'12%',
            containLabel: true
        },

        calculable: true,
        xAxis: [
            {
                type: 'category',
                // prettier-ignore
                data: v3,
                axisLine:{
                    lineStyle:{
                        color:'white',
                        // width:2
                    }
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                axisLine:{
                    lineStyle:{
                        color:'white',
                    }
                }
            }
        ],
        series: [

            {
                name: v1,
                type: 'bar',
                data: d1,
                textStyle: {  //数值样式
                    color: c1[0],   //字体颜色
                    fontSize: 14  //字体大小
                }

            },
            {
                name: v2,
                type: 'bar',
                data: d2,
                textStyle: {  //数值样式
                    color:c1[2],    //字体颜色
                    fontSize: 14  //字体大小
                }

            }
        ]
    }

}
//环形饼状图横向legend带引导线
function myoptionpie8(t1,d,pc1='60%') {
    return {
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b} : {c} ({d}%)'
        },
        legend: {
            icon: "circle",
            //icon形状  类型包括 circle，rect ，roundRect，triangle，diamond，pin，arrow，none,
            // itemWidth: 17,  // 设置icon宽度
            // itemHeight: 17, // 设置icon高度
            // itemGap: 40, // 设置间距
            textStyle: {
                color: "#fff",
                // fontSize:20
            },
        },
        series: [
            {
                name: t1,
                type: 'pie',
                radius: ['40%', '70%'],
                center: [pc1, '50%'],
                avoidLabelOverlap: false,
                itemStyle: {
                    borderRadius: 10,
                    borderColor: '#fff',
                    borderWidth: 2
                },
                label:{
                    color:'#fff'
                    // ,fontSize:19
                    ,formatter: '{b} : {c} ({d}%)'
                }, labelLine: {
                    length: 15,
                    length2: 6,
                },
                data:d,
            }
        ]
    };
}

function mypie1(t1,d,title,y1,c1=['#293fff','red','yellow','#FFA100'],xp='right') {
    return {
        tooltip: {
            trigger: 'item',
            position:xp,
            formatter: '{a} <br/>{b} : {c} ({d}%)'
        },

        title: {
            text: title,
            top: 'center',
            left: 'center',
            textStyle:{
                //文字颜色
                color:'yellow',
                //字体粗细 'normal','bold','bolder','lighter',100 | 200 | 300 | 400...
                // fontWeight:'bold',
                //字体大小
                fontSize:12
            }
        },
        color: c1,
        series: [
            {
                name: t1,
                type: 'pie',
                // center:['top','center'],
                radius: ['40%', y1],
                // itemStyle: {
                //     borderRadius: 2,
                //     borderColor: '#fff',
                //     borderWidth: 0.5
                // },
                label: {
                    show: false,
                    position: 'center'
                },


                labelLine: {
                    show: false
                },
                data:d,

            }
        ]
    };
}
function mypie2(t1,d,title,y1,c1=['#293fff','red','yellow','#FFA100']) {
    return {
        tooltip: {
            trigger: 'item',
            position:'right',
            formatter: '{a} <br/>{b} : {c} ({d}%)'
        },

        title: {
            text: title,
            top: 'center',
            left: 'center',
            textStyle:{
                //文字颜色
                color:'white',
                //字体粗细 'normal','bold','bolder','lighter',100 | 200 | 300 | 400...
                // fontWeight:'bold',
                //字体大小
                fontSize:12
            }
        },
        color: c1,
        series: [
            {
                name: t1,
                type: 'pie',
                // center:['top','center'],
                radius: ['0%', '100%'],
                // itemStyle: {
                //     borderRadius: 2,
                //     borderColor: '#fff',
                //     borderWidth: 0.5
                // },
                label: {
                    show: false,
                    position: 'center'
                },


                labelLine: {
                    show: false
                },
                data:d,

            }
        ]
    };
}
function mypie3(t1,d,title,y1,c1=['#293fff','red','yellow','#FFA100'],xp='right',lp='21%',gap=40) {
    return {
        tooltip: {
            trigger: 'item',
            position:xp,
            formatter: '{a} <br/>{b} : {c} ({d}%)'
        },
        legend: {
            icon: "circle",
            //icon形状  类型包括 circle，rect ，roundRect，triangle，diamond，pin，arrow，none,
            itemWidth: 15,  // 设置icon宽度
            itemHeight: 15, // 设置icon高度
            itemGap:gap, // 设置间距
            top: 'center',//竖直位置
            left: 'right',//水平位置
            // x: 50,//水平位置
            // y: 200,//竖直位置
            orient: "vertical",//设置显示顺序，默认水平（水平，竖直）
            textStyle: {
                color: "#fff",
                fontSize:14
            },
        },

        title: {
            text: title,
            top: 'center',
            left: lp,
            textStyle:{
                //文字颜色
                color:'white',
                //字体粗细 'normal','bold','bolder','lighter',100 | 200 | 300 | 400...
                // fontWeight:'bold',
                //字体大小
                fontSize:12
            }
        },
        color: c1,
        series: [
            {
                name: t1,
                type: 'pie',
                center: ['30%', '50%'],
                radius: ['40%', y1],
                // itemStyle: {
                //     borderRadius: 2,
                //     borderColor: '#fff',
                //     borderWidth: 0.5
                // },
                label: {
                    show: false,
                    position: 'center'
                },


                labelLine: {
                    show: false
                },
                data:d,

            }
        ]
    };
}

function mypie4(t1,d,title,y1,c1=['#293fff','red','yellow','#FFA100'],xp='right') {
    return {
        tooltip: {
            trigger: 'item',
            position:xp,
            formatter: '{a} <br/>{b} : {c} ({d}%)'
        },
        legend: {
            // icon: "circle",
            //icon形状  类型包括 circle，rect ，roundRect，triangle，diamond，pin，arrow，none,
            itemWidth: 15,  // 设置icon宽度
            itemHeight: 15, // 设置icon高度
            // top:'5%',
            // itemGap:gap, // 设置间距
            // bottom: '-10',//竖直位置
            // left: 'right',//水平位置
            // orient: "vertical",//设置显示顺序，默认水平（水平，竖直）
            textStyle: {
                color: "#fff",
                fontSize:14
            },
        },
        title: {
            text: title,
            top: 'center',
            left: 'center',
            textStyle:{
                //文字颜色
                color:'yellow',
                //字体粗细 'normal','bold','bolder','lighter',100 | 200 | 300 | 400...
                // fontWeight:'bold',
                //字体大小
                fontSize:12
            }
        },
        color: c1,
        series: [
            {
                name: t1,
                type: 'pie',
                // center:['top','center'],
                radius: ['40%', y1],
                // itemStyle: {
                //     borderRadius: 2,
                //     borderColor: '#fff',
                //     borderWidth: 0.5
                // },
                label: {
                    show: false,
                    position: 'center'
                },


                labelLine: {
                    show: false
                },
                data:d,

            }
        ]
    };
}

function mypie5(t1,d,title,y1,c1=['#293fff','red','yellow','#FFA100'],xp='right') {
    return {
        tooltip: {
            trigger: 'item',
            position:xp,
            formatter: '{a} <br/>{b} : {c} ({d}%)'
        },        legend: {
            icon: "circle",
            //icon形状  类型包括 circle，rect ，roundRect，triangle，diamond，pin，arrow，none,
            itemWidth: 15,  // 设置icon宽度
            itemHeight: 15, // 设置icon高度
            // itemGap:gap, // 设置间距
            top: 'center',//竖直位置
            left: 'left',//水平位置
            // x: 50,//水平位置
            // y: 200,//竖直位置
            orient: "vertical",//设置显示顺序，默认水平（水平，竖直）
            textStyle: {
                color: "#fff",
                fontSize:14
            },
        },

        title: {
            text: title,
            top: 'center',
            left: 'center',
            textStyle:{
                //文字颜色
                color:'yellow',
                //字体粗细 'normal','bold','bolder','lighter',100 | 200 | 300 | 400...
                // fontWeight:'bold',
                //字体大小
                fontSize:12
            }
        },
        color: c1,
        series: [
            {
                name: t1,
                type: 'pie',
                // center:['top','right'],
                radius: ['40%', y1],
                // itemStyle: {
                //     borderRadius: 2,
                //     borderColor: '#fff',
                //     borderWidth: 0.5
                // },
                label: {
                    show: true,
                    position: 'inner',
                    // textStyle:{
                    //     fontSize:12
                    // }
                },


                labelLine: {
                    show: false
                },
                data:d,

            }
        ]
    };
}