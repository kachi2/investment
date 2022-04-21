/*! Investorm v1.1.0 | Copyright by Softnio. */
!function(NioApp,$){"use strict";function chartSightBar(selector,set_data){var $selector=selector?$(selector):$(".chart-insight");$selector.each(function(){for(var $self=$(this),_self_id=$self.attr("id"),_gd="undefined"==typeof set_data?eval(_self_id):set_data,selectCanvas=document.getElementById(_self_id).getContext("2d"),chart_data=[],i=0;i<_gd.datasets.length;i++)chart_data.push({label:_gd.datasets[i].label,data:_gd.datasets[i].data,backgroundColor:_gd.datasets[i].color,borderWidth:2,borderColor:"transparent",hoverBorderColor:"transparent",borderSkipped:"bottom",barPercentage:_gd.barPercent?_gd.barPercent:.6,categoryPercentage:_gd.barPercent?_gd.barPercent:.6});var chart=new Chart(selectCanvas,{type:"bar",data:{labels:_gd.labels,datasets:chart_data},options:{layout:{padding:{left:0,right:0,top:10,bottom:0}},legend:{display:!!_gd.legend&&_gd.legend,labels:{boxWidth:12,padding:12,fontColor:"#526484"}},maintainAspectRatio:!1,tooltips:{enabled:!!_gd.tooltip&&_gd.tooltip,callbacks:{title:function(a,b){return b.labels[a[0].index]},label:function(a,b){return b.datasets[a.datasetIndex].data[a.index]+" "+_gd.dataUnit+" / "+b.datasets[a.datasetIndex].label}},backgroundColor:"#1c2b46",titleFontSize:12,titleFontColor:"#ecf2ff",titleMarginBottom:6,bodyFontColor:"#fff",bodyFontSize:12,bodySpacing:4,yPadding:8,xPadding:10,footerMarginTop:2,displayColors:!1},scales:{yAxes:[{display:!0,stacked:!!_gd.stacked&&_gd.stacked,ticks:{beginAtZero:!0,fontSize:11,fontColor:"#9eaecf",padding:10,min:_gd.scales&&_gd.scales.min?_gd.scales.min:100,max:_gd.scales&&_gd.scales.max?_gd.scales.max:1e4,stepSize:_gd.scales&&_gd.scales.step?_gd.scales.step:1e3},gridLines:{color:"#e5ecf8",tickMarkLength:0,zeroLineColor:"#e5ecf8"}}],xAxes:[{display:!0,stacked:!!_gd.stacked&&_gd.stacked,ticks:{fontSize:9,fontColor:"#9eaecf",source:"auto",padding:10},gridLines:{color:"transparent",tickMarkLength:0,zeroLineColor:"transparent"}}]}}})})}function ChartMinBar(selector,set_data){var $selector=selector?$(selector):$(".chart-minibar");$selector.each(function(){for(var $self=$(this),_self_id=$self.attr("id"),_gd="undefined"==typeof set_data?eval(_self_id):set_data,_d_legend="undefined"!=typeof _gd.legend&&_gd.legend,selectCanvas=document.getElementById(_self_id).getContext("2d"),chart_data=[],i=0;i<_gd.datasets.length;i++)chart_data.push({label:_gd.datasets[i].label,data:_gd.datasets[i].data,backgroundColor:_gd.datasets[i].color,borderWidth:2,borderColor:"transparent",hoverBorderColor:"transparent",borderSkipped:"bottom",barPercentage:.8,categoryPercentage:.8});var chart=new Chart(selectCanvas,{type:"bar",data:{labels:_gd.labels,datasets:chart_data},options:{legend:{display:!!_gd.legend&&_gd.legend,labels:{boxWidth:30,padding:20,fontColor:"#6783b8"}},maintainAspectRatio:!1,tooltips:{enabled:!!_gd.tooltip&&_gd.tooltip,callbacks:{title:function(){return!1},label:function(a,b){return b.datasets[a.datasetIndex].data[a.index]+" "+_gd.dataUnit+" / "+b.labels[a.index]}},backgroundColor:"#1c2b46",titleFontSize:12,titleFontColor:"#ecf2ff",titleMarginBottom:6,bodyFontColor:"#fff",bodyFontSize:12,bodySpacing:4,yPadding:8,xPadding:10,footerMarginTop:2,displayColors:!1},scales:{yAxes:[{display:!1,stacked:!!_gd.stacked&&_gd.stacked,ticks:{beginAtZero:!0}}],xAxes:[{display:!1,stacked:!!_gd.stacked&&_gd.stacked}]}}})})}function chartLiner(selector,set_data){var $selector=selector?$(selector):$(".chart-liner");$selector.each(function(){for(var bgColor,$self=$(this),_self_id=$self.attr("id"),_gd="undefined"==typeof set_data?eval(_self_id):set_data,selectCanvas=document.getElementById(_self_id).getContext("2d"),chart_data=[],i=0;i<_gd.datasets.length;i++){if(bgColor=_gd.datasets[i].background,"gradient"==_gd.datasets[i].background){var bgColor=selectCanvas.createLinearGradient(0,0,0,100);bgColor.addColorStop(0,NioApp.hexRGB(_gd.datasets[i].color,.5)),bgColor.addColorStop(1,NioApp.hexRGB(_gd.datasets[i].color,.01))}else"solid"==_gd.datasets[i].background&&(bgColor=NioApp.hexRGB(_gd.datasets[i].color,.5));chart_data.push({label:_gd.datasets[i].label,tension:_gd.lineTension,backgroundColor:bgColor,borderWidth:_gd.datasets[i].borderWidth,borderColor:_gd.datasets[i].color,pointBorderColor:_gd.showDots?NioApp.hexRGB(_gd.datasets[i].color,.9):"transparent",pointBackgroundColor:_gd.showDots?_gd.datasets[i].color:"transparent",pointHoverBackgroundColor:_gd.tooltip?"#fff":_gd.datasets[i].color,pointHoverBorderColor:_gd.datasets[i].color,pointBorderWidth:_gd.showDots?2:1,pointHoverRadius:_gd.tooltip?_gd.datasets[i].borderWidth+2:1,pointHoverBorderWidth:_gd.tooltip?2:1,pointRadius:_gd.tooltip?_gd.datasets[i].borderWidth+2:1,pointHitRadius:_gd.tooltip?_gd.datasets[i].borderWidth+2:1,data:_gd.datasets[i].data})}var chart=new Chart(selectCanvas,{type:"line",data:{labels:_gd.labels,datasets:chart_data},options:{layout:{padding:{left:0,right:0,top:5,bottom:1}},legend:{position:"top",align:"start",display:!!_gd.legend&&_gd.legend,labels:{boxWidth:2,boxHeight:2,fontSize:11,padding:10,fontColor:"#526484"}},maintainAspectRatio:!1,tooltips:{enabled:!!_gd.tooltip&&_gd.tooltip,callbacks:{title:function(a,b){return"single"!==_gd.tooltipStyle&&b.labels[a[0].index]+" / "+b.datasets[a[0].datasetIndex].label},label:function(a,b){return b.datasets[a.datasetIndex].data[a.index]+" "+_gd.dataUnit+("single"===_gd.tooltipStyle?" / "+b.labels[a.index]:"")}},backgroundColor:"#1c2b46",titleFontSize:12,titleFontColor:"#ecf2ff",titleMarginBottom:6,bodyFontColor:"#fff",bodyFontSize:12,bodySpacing:4,yPadding:8,xPadding:10,footerMarginTop:2,displayColors:!1},scales:{yAxes:[{display:!1,ticks:{beginAtZero:!0,fontSize:10,fontColor:"#9eaecf",padding:5},gridLines:{color:"#e5ecf8",tickMarkLength:1,zeroLineColor:"#e5ecf8"}}],xAxes:[{display:!1,ticks:{fontSize:11,fontColor:"#9eaecf",source:"auto",padding:2},gridLines:{color:"transparent",tickMarkLength:0,zeroLineColor:"#e5ecf8",offsetGridLines:!0}}]}}})})}function chartLinerGrid(selector,set_data){var $selector=selector?$(selector):$(".chart-liner-grid");$selector.each(function(){for(var bgColor,$self=$(this),_self_id=$self.attr("id"),_gd="undefined"==typeof set_data?eval(_self_id):set_data,selectCanvas=document.getElementById(_self_id).getContext("2d"),chart_data=[],i=0;i<_gd.datasets.length;i++){if(bgColor=_gd.datasets[i].background,"gradient"==_gd.datasets[i].background){var bgColor=selectCanvas.createLinearGradient(0,0,0,100);bgColor.addColorStop(0,NioApp.hexRGB(_gd.datasets[i].color,.5)),bgColor.addColorStop(1,NioApp.hexRGB(_gd.datasets[i].color,.01))}else"solid"==_gd.datasets[i].background&&(bgColor=NioApp.hexRGB(_gd.datasets[i].color,.5));chart_data.push({label:_gd.datasets[i].label,tension:_gd.lineTension,backgroundColor:bgColor,borderWidth:_gd.datasets[i].borderWidth,borderColor:_gd.datasets[i].color,pointBorderColor:_gd.showDots?"#fff":"transparent",pointBackgroundColor:_gd.showDots?_gd.datasets[i].color:"transparent",pointHoverBackgroundColor:_gd.tooltip?"#fff":_gd.datasets[i].color,pointHoverBorderColor:_gd.datasets[i].color,pointBorderWidth:_gd.showDots?2:1,pointHoverRadius:_gd.tooltip?_gd.datasets[i].borderWidth+2:1,pointHoverBorderWidth:_gd.tooltip?2:1,pointRadius:_gd.tooltip?_gd.datasets[i].borderWidth+2:1,pointHitRadius:_gd.tooltip?_gd.datasets[i].borderWidth+2:1,data:_gd.datasets[i].data})}var chart=new Chart(selectCanvas,{type:"line",data:{labels:_gd.labels,datasets:chart_data},options:{layout:{padding:{left:2,right:2,top:10,bottom:1}},legend:{position:"top",align:"start",display:!!_gd.legend&&_gd.legend,labels:{boxWidth:2,boxHeight:2,fontSize:11,padding:10,fontColor:"#526484"}},maintainAspectRatio:!1,tooltips:{enabled:!!_gd.tooltip&&_gd.tooltip,callbacks:{title:function(a,b){return"single"!==_gd.tooltipStyle&&b.labels[a[0].index]+" / "+b.datasets[a[0].datasetIndex].label},label:function(a,b){return b.datasets[a.datasetIndex].data[a.index]+" "+_gd.dataUnit+("single"===_gd.tooltipStyle?" / "+b.labels[a.index]:"")}},backgroundColor:"#1c2b46",titleFontSize:12,titleFontColor:"#ecf2ff",titleMarginBottom:6,bodyFontColor:"#fff",bodyFontSize:12,bodySpacing:4,yPadding:8,xPadding:10,footerMarginTop:2,displayColors:!1},scales:{yAxes:[{display:!1,ticks:{beginAtZero:!0,fontSize:10,fontColor:"#9eaecf",padding:4},gridLines:{color:"#e5ecf8",tickMarkLength:1,zeroLineColor:"#e5ecf8"}}],xAxes:[{display:!1,ticks:{display:!1,fontSize:10,fontColor:"#9eaecf",source:"auto",padding:3},gridLines:{color:"transparent",tickMarkLength:1,zeroLineColor:"#e5ecf8",offsetGridLines:!0}}]}}})})}function chartBar(selector,set_data){var $selector=selector?$(selector):$(".chart-bar");$selector.each(function(){for(var $self=$(this),_self_id=$self.attr("id"),_gd="undefined"==typeof set_data?eval(_self_id):set_data,selectCanvas=document.getElementById(_self_id).getContext("2d"),chart_data=[],i=0;i<_gd.datasets.length;i++)chart_data.push({label:_gd.datasets[i].label,data:_gd.datasets[i].data,backgroundColor:_gd.datasets[i].color,borderWidth:0,borderColor:_gd.datasets[i].color,hoverBorderColor:_gd.datasets[i].color,borderSkipped:"bottom",barPercentage:.8,categoryPercentage:.6});var chart=new Chart(selectCanvas,{type:"bar",data:{labels:_gd.labels,datasets:chart_data},options:{layout:{padding:{left:0,right:0,top:10,bottom:0}},legend:{display:!!_gd.legend&&_gd.legend,labels:{boxWidth:12,padding:12,fontColor:"#526484"}},maintainAspectRatio:!1,tooltips:{enabled:!!_gd.tooltip&&_gd.tooltip,callbacks:{title:function(a,b){return"single"!==_gd.tooltipStyle&&b.labels[a[0].index]},label:function(a,b){return b.datasets[a.datasetIndex].data[a.index]+" "+_gd.dataUnit+" / "+b.datasets[a.datasetIndex].label+("single"===_gd.tooltipStyle?" / "+b.labels[a.index]:"")}},backgroundColor:"#1c2b46",titleFontSize:12,titleFontColor:"#ecf2ff",titleMarginBottom:6,bodyFontColor:"#fff",bodyFontSize:12,bodySpacing:4,yPadding:8,xPadding:10,footerMarginTop:2,displayColors:!1},scales:{yAxes:[{display:!1,stacked:!!_gd.stacked&&_gd.stacked,ticks:{beginAtZero:!0}}],xAxes:[{display:!1,stacked:!!_gd.stacked&&_gd.stacked}]}}})})}function chartDnut(selector,set_data){var $selector=selector?$(selector):$(".chart-dnut");$selector.each(function(){for(var $self=$(this),_self_id=$self.attr("id"),_get_data="undefined"==typeof set_data?eval(_self_id):set_data,selectCanvas=document.getElementById(_self_id).getContext("2d"),chart_data=[],i=0;i<_get_data.datasets.length;i++)chart_data.push({backgroundColor:_get_data.datasets[i].background,borderWidth:2,borderColor:_get_data.datasets[i].borderColor,hoverBorderColor:_get_data.datasets[i].borderColor,data:_get_data.datasets[i].data});var chart=new Chart(selectCanvas,{type:"doughnut",data:{labels:_get_data.labels,datasets:chart_data},options:{legend:{display:!!_get_data.legend&&_get_data.legend,labels:{boxWidth:12,padding:20,fontColor:"#6783b8"}},rotation:-1.5,cutoutPercentage:70,maintainAspectRatio:!1,tooltips:{enabled:!0,callbacks:{title:function(a,b){return b.labels[a[0].index]},label:function(a,b){return b.datasets[a.datasetIndex].data[a.index]+" "+_get_data.dataUnit}},backgroundColor:"#1c2b46",titleFontSize:12,titleFontColor:"#ecf2ff",titleMarginBottom:6,bodyFontColor:"#fff",bodyFontSize:12,bodySpacing:4,yPadding:8,xPadding:10,footerMarginTop:2,displayColors:!1}}})})}NioApp.coms.docReady.push(function(){chartSightBar(),ChartMinBar(),chartLiner(),chartLinerGrid(),chartBar(),chartDnut()})}(NioApp,jQuery);