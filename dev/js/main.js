
  //过滤集合 
  app.filter("htmlfil", ["$sce", function($sce) {
    //过滤html    
    return function(text) {
      return $sce.trustAsHtml(text);
    };
  }]);

  //标准过滤格式    
  app.filter("myfil", ["fac", function(fac) {
    return function(data, item) {
      var newarr = [];
      angular.forEach(data, function(value, key) {
        if (value.pid == item) {
          newarr.push(value);
        }
      });
      return newarr;
    };
  }]);
  //1. main_ctrl  最外层的ctrl
  app.controller('main_ctrl', ['$scope', 'fac', function($scope, fac) {
    $scope.cd = {};
    $scope.getmenu = [];
    $.ajax({
      type: "post",
      url: window.root + "open/menutree_select?token=" + fac.getstore('ystoken'),
      data: {
        debug: 0
      },
      async: false,
      success: function(re) {
        $scope.getmenu.data = re.data;
        $scope.cd = re.arr;
      }
    });

    // 判断登录状态
    $scope.we = '';
    $.ajax({
      type: "post",
      url: window.root + "open/islogin?token=" + fac.getstore('ystoken'),
      async: false,
      success: function(k) {
        // var obj = eval("("+k+")");
        $scope.we = k.code;

      }
    });
    // YS('bootstrap');
    // YS('fullCalendar');
    // YS('form');
    // YS('qqface');
    // YS('laypage');
    // YS('swiper.min');
    // YS('myjs');
    // YS('myjsone.min');
    // YS('content');
    // YS('main2048');
    // YS('jwe');
    // setTimeout(function() {
    //   YS('laydate');
    // }, 1000);
    // YS('slimScroll', function() {
      // $('.sidebar-collapse').slimScroll({
      //   height: '100%',
      //   railOpacity: 0.9,
      //   alwaysVisible: false
      // });
    // });
    //  YS('shCircleLoader',function() {
    //   $('#loader').shCircleLoader({color:'#2AA2D4'});
    // });
    // YS('layer');
    $scope.ysmid = $scope.$id;
    // $scope.getmenu = {
    //  done:function(re,sco){
    //     debugger;
    //     $scope.cd=re.arr;
    //     YS('slimScroll',function(){
    //       $('.sidebar-collapse').slimScroll({
    //           height: '100%',
    //           railOpacity: 0.9,
    //            color: '#ffcc00',
    //           alwaysVisible: false
    //       });
    //     }); 

    //  }
    // };
    //    fac.ysfetch($scope,'getmenu');
    // 推出登录
    $scope.lgout = {
      done: function(re, sco) {
        fac.unsetstore('ystoken');
        window.location.href = "/admin.php";
      }
    };
    fac.ysfetch($scope, 'lgout');


    $scope.findchk = function(id, inje) {
      var arr = inje.split(',');
      var a = false;
      arr.map(function(el) {
        if (id == el) {
          a = true;
        }
      });
      return a;
    };


    function getpage() {
      var url = location.href.split('#');
      url = url[1] || '/index';
      if (url.indexOf("?") > 0) {
        fac.setstore('hash', fac.hashtoobj(url.split('?')[1]));
        url = url.split('?')[0];
      }
      var arr = url.split('/');
      arr.shift();
      url = './html/' + arr.join('_');

      return url + '.html?time=' + fac.time();
    }

    $scope.body = {
      url: getpage()
    };
    window.onhashchange = function() {
      $scope.body.url = getpage();
      // dosetmenu($scope);
      // $scope.$apply();
      window.location.reload();

    };
    $scope.mainshow = 0;

    // $scope.menufind = function(str){
    //   var a = location.href.split('#/');  
    //  var ax= a[1]==str?'active_bg':''; 
    //  return ax;
    // };

    // $scope.chkmenu = function(val){
    //   val.cls = val.cls==''||val.cls==undefined?'active':'';
    // };

    //jq代码
    // $("#scNav").on("click", ".nav_li", function () { 
    //             $("#scNav>li").attr("class", "nav_li");
    //             var cl = $(this).children("a").attr("class"); 
    //             $(".sc_nav_list li").removeClass("active_bg");
    //             $(this).addClass("active_bg"); 
    //         });
    //     $(".sc_nav_list>li").on("click", function () { 
    //       $(this).addClass('acitve').siblings().removeClass('acitve');
    //     });


  }]);
  //2. com_ctrl   公共ctrl
  app.controller('com_ctrl', ['$scope', 'fac', 'hdl', function($scope, fac, hdl) {
    $scope.yscid = $scope.$id;
    // textarea计数
    $scope.count = function() {
      $scope.len = $scope.com_editadd.params.specialty.length;
    };
    $scope.workcount = function() {
      $scope.worklen = $scope.com_editadd.params.description.length;
    };
    $scope.studycount = function() {
      $scope.studylen = $scope.com_editadd.params.description.length;
    };
    $scope.procount = function() {
      $scope.prolen = $scope.com_editadd.params.description.length;
    };
    // 公共编辑更新一条
    // YS("city", function() {
      $scope.city = function(e) {
        SelCity(this, e);
      };
    // });

    $scope.com_update = {
      time: 0,
      params: {},
      data: {},
      done: function(re, sco) {
        layer.msg('更新成功');
      }
    };

    fac.ysfetch($scope, 'com_update');

    // 公共列表无分页
    $scope.com_list = {
      time: 0,
      params: {},
      data: {}
    };
    fac.ysfetch($scope, 'com_list');
    $scope.com_list2 = {
      time: 0,
      params: {},
      data: {}
    };
    fac.ysfetch($scope, 'com_list2');

    $scope.com_list3 = {
      time: 0,
      params: {},
      data: {}
    };
    fac.ysfetch($scope, 'com_list3');

    $scope.com_list4 = {
      time: 0,
      params: {},
      data: {}
    };
    fac.ysfetch($scope, 'com_list4');

    $scope.com_list5 = {
      time: 0,
      params: {},
      data: {}
    };
    fac.ysfetch($scope, 'com_list5');

    $scope.com_list6 = {
      time: 0,
      params: {},
      data: {}
    };
    fac.ysfetch($scope, 'com_list6');
    // 公共分页列表
    $scope.com_list_page = {
      time: 0,
      params: {},
      data: {}
    };
    fac.ysfetch($scope, 'com_list_page');
    $scope.com_list_page2 = {
      time: 0,
      params: {},
      data: {}
    };
    fac.ysfetch($scope, 'com_list_page2');

    $scope.com_list_page3 = {
      time: 0,
      params: {},
      data: {}
    };
    fac.ysfetch($scope, 'com_list_page3');

    $scope.com_detail = {
      time: 0,
      params: {},
      data: {}
    };
    fac.ysfetch($scope, 'com_detail');
    $scope.com_detail2 = {
      time: 0,
      params: {},
      data: {}
    };
    fac.ysfetch($scope, 'com_detail2');
    $scope.com_detail3 = {
      time: 0,
      params: {},
      data: {}
    };
    fac.ysfetch($scope, 'com_detail3');
    // 公共删除
    $scope.com_del = {
      time: 0,
      params: {},
      data: {}
    };
    fac.ysfetch($scope, 'com_del');
    $scope.com_del2 = {
      time: 0,
      params: {},
      data: {}
    };
    fac.ysfetch($scope, 'com_del2');
    // 公共增加和编辑
    $scope.com_editadd = {
      time: 0,
      params: {},
      data: {}
    };
    fac.ysfetch($scope, 'com_editadd');

    // 公共增加和编辑
    $scope.com_editadd2 = {
      time: 0,
      params: {},
      data: {}
    };
    fac.ysfetch($scope, 'com_editadd2');

    // 公共增加和编辑
    $scope.com_editadd3 = {
      time: 0,
      params: {},
      data: {}
    };
    fac.ysfetch($scope, 'com_editadd3');

    // 公共增加和编辑
    $scope.com_editadd4 = {
      time: 0,
      params: {},
      data: {}
    };
    fac.ysfetch($scope, 'com_editadd4');
    // 公共增加和编辑
    $scope.com_editadd5 = {
      time: 0,
      params: {},
      data: {}
    };
    fac.ysfetch($scope, 'com_editadd5');
    var a = location.href.split('#');
    url = a[1] || '/index';

    if (url.indexOf("?") > 0) {
      fac.setstore('hash', fac.hashtoobj(url.split('?')[1]));
      url = url.split('?')[0];
    }



    var urlarr = url.split('/');
    urlarr.shift();
    var t = urlarr.join('_');
    var module = hdl[t];
    for (var k in module) {
      if (k == 'init') {
        hdl[t][k]($scope);
      } else {
        var key = t + '_' + k;
        $scope[key] = angular.copy(module[k]);
        fac.ysfetch($scope, key);
      }
    }
    //默认出事状态，第一页0；
    $scope.value = {};
    $scope.tapshow = 0;



    $scope.toggleshow = 0;
    $scope.toggshow = 0;
    //默认页面是编辑状态，0，非编辑，1编辑状态
    $scope.editstatus = 0;


    //日志首页点击直接跳转到编辑框
    fac.setstore('guanjian2', fac.hashtoobj2(fac.getstore('guanjian')));
    var style1 = fac.getstore('guanjian2');
    if (style1['codeid1']) {
      var cscope = fac.getscope_byid($scope, $scope.yscid);
      cscope.com_list.url = 'auth/diary_list1'; //日记风格分类
      cscope.com_list.params = {
        "codeid": fac.getcd(cscope, 'c5'),
        "c_alias": "QS_diary",
        "orderstrid": 3
      };
      cscope.com_list.time = fac.time();
      cscope.toggleshow = 1;
      // YS("ueditor", function() {
        UE.getEditor('editor');
        setTimeout(function() {
          UE.getEditor('editor').destroy();
          UE.getEditor('editor');
        }, 1);
      // });
      cscope.com_editadd4.params.content = style1['content1'];
      cscope.com_editadd4.params.codeid = style1['codeid1'];
      cscope.com_editadd4.params.diarystyle = parseInt(style1['diarystyle1']);
      cscope.com_editadd4.before = function(cscope) {
        cscope.com_editadd4.params.content = UE.getEditor('editor').getContent();
      };
      cscope.com_editadd4.done = function(re, cscope) {
        if (re.data) {
          layer.msg('编辑成功');
          setTimeout(function() {
            window.location.reload();
          }, 1000);
        }
      }; //日记编辑
      fac.setstore('guanjian', '');
      fac.setstore('guanjian2', '');
    }
    if (style1['diarystyle2']) {
      var cscope = fac.getscope_byid($scope, $scope.yscid);
      cscope.com_list_page.params.diarystyle = parseInt(style1['diarystyle2']);
      fac.setstore('guanjian', '');
      fac.setstore('guanjian2', '');
    }
    //日志首页点击直接跳转到编辑框


  }]);

  // 日期插件
  app.directive('layerdateone', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var arr = iAttrs.layerdateone.split('.');
          laydate.skin('yalan');
          laydate({
            format: 'YYYY-MM-DD', // hh:mm:ss 分隔符可以任意定义，该例子表示只显示年月
            festival: true, //显示节日
            istime: true,
            istoday: true,
            choose: function(datas) { //选择日期完毕的回调 
              cscope[arr[0]][arr[1]][arr[2]] = datas;
            }
          });
        });
      }
    };
  }]);



  //公共方法，编辑状态的切换
  app.directive('editstatus', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope.editstatus = iAttrs.editstatus;
          cscope.$apply();
        });
      }
    };
  }]);


  //推出登录
  app.directive('lgout', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.ysmid);
          cscope.lgout.done = function(re, sco) {
            layer.msg('成功退出登录');
            cscope.we = '0';
          };
          cscope.lgout.time = fac.time();
          cscope.$apply();
          setTimeout(function() {
            window.location.href = "login.html";
          }, 1000);
        });
      }
    };
  }]);


  // 公共删除方法 
  app.directive('comdelone', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var obj = iAttrs.comdelone;
          var theid = iAttrs.theid || 'id';
          var tip = iAttrs.tip ? iAttrs.tip : '您确定要删除么？';
          var layercon = layer.confirm(tip, {
            btn: ['确定', '取消'] //按钮
          }, function() {
            // // 触发时间时间戳  
            cscope[obj].params[theid] = $scope.value[theid];
            cscope[obj].done = function(re) {
              if (re.code == 1) {
                $scope.value.isdel = 1;
                layer.msg("删除成功");
              } else {
                layer.msg("删除失败");
              }
              layer.close(layercon);
            };
            cscope[obj].time = fac.time();
            cscope.$apply();
          });
        });
      }
    };
  }]);
  // // 公共删除方法 
  //  app.directive('comdeloneimg',['fac', function(fac){ 
  // return { 
  //     link: function($scope, iElm, iAttrs, controller){
  //         iElm.on("click",function(){ 
  //            var cscope = fac.getscope_byid($scope,$scope.yscid); 
  //            var arr = iAttrs.comdeloneimg.split('.');
  //         cscope[arr[0]][arr[1]][arr[2]]= iAttrs.value;
  //         $scope.value[arr[2]] = iAttrs.value; 
  //            cscope[arr[0]].time = fac.time(); 
  //            cscope.$apply();  
  //         });
  //      }
  //    };
  // }]);

  // 公共提问并执行方法 
  app.directive('comaskrun', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var obj = iAttrs.comaskrun;
          var theid = iAttrs.theid || 'id';
          var tip = iAttrs.tip ? iAttrs.tip : '您确定要提交么？';
          var layercon = layer.confirm(tip, {
            btn: ['确定', '取消'] //按钮
          }, function() {
            // // 触发时间时间戳  
            cscope[obj].params[theid] = $scope.value[theid];
            cscope[obj].done = function(re) {
              layer.msg(re.msg);
              layer.close(layercon);
            };
            cscope[obj].time = fac.time();
            cscope.$apply();
          });


        });
      }
    };
  }]);
  // 公共通过方法 
  app.directive('comdone', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var arr = iAttrs.comdone.split('.');
          var theid = iAttrs.key || 'id';
          cscope[arr[0]][arr[1]][theid] = $scope.value[theid];
          cscope[arr[0]][arr[1]][arr[2]] = parseInt(iAttrs.v);
          $scope.value[arr[2]] = parseInt(iAttrs.v);
          cscope[arr[0]].time = fac.time();
          cscope.$apply();
        });
      }
    };
  }]);

  //公共触发时间戳
  app.directive('comtime', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope[iAttrs.comtime].time = fac.time();
          cscope.$apply();
        });
      }
    };
  }]);

  //公共编辑
  app.directive('comedit', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          fac.setstore('id', iAttrs.comedit);
        });
      }
    };
  }]);


  //公共select 的选择事件
  app.directive('ysselect', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("change", function() {
          var arr = iAttrs.ysselect.split('.');
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope[arr[0]][arr[1]][arr[2]] = $(this).val();
          cscope.$apply();
        });
      }
    };
  }]);

  app.directive('ysupdateone', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("change", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var arr = iAttrs.ysupdateone.split('.');
          cscope[arr[0]][arr[1]] = $scope.value;
          cscope[arr[0]][arr[1]][arr[2]] = $(this).val();
          cscope[arr[0]].time = fac.time();
          cscope.$apply();
        });
      }
    };
  }]);
  app.directive('ysupdatetwo', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var arr = iAttrs.ysupdatetwo.split('.');
          var theid = iAttrs.theid;
          cscope[arr[0]][arr[1]][theid] = $scope.value[theid];
          cscope[arr[0]].time = fac.time();
          cscope.$apply();
        });
      }
    };
  }]);
  //公共tap切换
  app.directive('selecttap', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var arr = iAttrs.selecttap.split('.');
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope[arr[0]][arr[1]][arr[2]] = iAttrs.val;
          cscope.$apply();
        });
      }
    };
  }]);

  //存store
  app.directive('setstore', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          fac.setstore(iAttrs.key, iAttrs.setstore);
        });
      }
    };
  }]);


  //公共下拉查询
  app.directive('ysselectrun', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("change", function() {
          var arr = iAttrs.ysselectrun.split('.');
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope[arr[0]][arr[1]][arr[2]] = $(this).val();
          cscope[arr[0]].time = fac.time();
          cscope.$apply();
        });
      }
    };
  }]);

  //公共 勾选所有；
  app.directive('ysselectall', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("change", function() {
          var arr = iAttrs.ysselectall.split('.');
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var list = arr[2] ? cscope[arr[0]][arr[1]][arr[2]] : cscope[arr[0]][arr[1]];
          list.map(function(el) {
            el.chk = $(iElm).is(':checked') ? 1 : 0;
          });
          cscope.$apply();
        });
      }
    };
  }]);

  //公共 勾选其中某一项；
  app.directive('ysselectone', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          $scope.value.chk = $scope.value.chk == 1 ? 0 : 1;
          cscope.$apply();
        });
      }
    };
  }]);

  //公共方法
  app.directive('yscheckrun', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var arr = iAttrs.yscheckrun.split('.');

          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var t = $(iElm).is(':checked');
          $scope.value[arr[2]] = t ? 1 : '0';
          cscope[arr[0]][arr[1]] = $scope.value;
          cscope[arr[0]].time = fac.time();
          cscope.$apply();
        });
      }
    };
  }]);


  //公共类型更新
  app.directive('ysupdaterun', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var arr = iAttrs.ysupdaterun.split('.');
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope[arr[0]][arr[1]][arr[2]] = $scope.value[arr[2]] == '' ? 1 : '';
          cscope[arr[0]][arr[1]][iAttrs.key] = $scope.value[iAttrs.key];
          $scope.value[arr[2]] = $scope.value[arr[2]] == '' ? 1 : '';
          cscope[arr[0]].time = fac.time();
          cscope.$apply();
        });
      }
    };
  }]);


  //公共  添加或编辑
  app.directive('yseditadd', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope[iAttrs.yseditadd].params = $scope.value || cscope.value;
          cscope.$apply();
        });
      }
    };
  }]);



  //私有  添加或编辑
  app.directive('ysaddpid', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope[iAttrs.ysaddpid].params.pid = $scope.value.id;
          cscope.$apply();
        });
      }
    };
  }]);

  app.directive('tapshow', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope.tapshow = iAttrs.tapshow;
          cscope.$apply();
        });
      }
    };
  }]);



  app.directive('mainshow', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.ysmid);
          cscope.mainshow = iAttrs.mainshow;
          cscope.$apply();
        });
      }
    };
  }]);



  app.directive('mkshow', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var key = iAttrs.mkshow;
          if (cscope[key] == 1) {
            cscope[key] = 0;
          } else {
            cscope[key] = 1;
          }

          cscope.$apply();
        });
      }
    };
  }]);

  app.directive('mkshowrun', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var key = iAttrs.mk;
          cscope[key] = 0;
          cscope[iAttrs.mkshowrun].time = fac.time();
          cscope.$apply();
        });
      }
    };
  }]);

  app.directive('toggleshow', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope.toggleshow = iAttrs.toggleshow;
          cscope.$apply();
        });
      }
    };
  }]);
  app.directive('toggleshowrun', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope.toggleshow = iAttrs.toggle;
          cscope[iAttrs.toggleshowrun].time = fac.time();
          cscope.$apply();
        });
      }
    };
  }]);
  app.directive('toggshow', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope.toggshow = iAttrs.toggshow;
          cscope.$apply();
        });
      }
    };
  }]);
  app.directive('toggshowrun', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope.toggshow = iAttrs.togg;
          cscope[iAttrs.toggshowrun].time = fac.time();
          cscope.$apply();
        });
      }
    };
  }]);
  app.directive('tapshowrun', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope.tapshow = iAttrs.tap;
          cscope[iAttrs.tapshowrun].time = fac.time();
          cscope.$apply();
        });
      }
    };
  }]);


  app.directive('ystaprun', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var arr = iAttrs.ystaprun.split('.');
          cscope[arr[0]][arr[1]][arr[2]] = $scope.value[arr[2]];
          cscope.tapshow = iAttrs.tap;
          cscope[arr[0]].time = fac.time();
          cscope.$apply();
        });
      }
    };
  }]);
  app.directive('ystaprun2', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope.mk1 = 0;
          cscope.mk3 = 0;
          var arr = iAttrs.ystaprun2.split('.');
          cscope[arr[0]][arr[1]][arr[2]] = iAttrs.value;
          cscope[arr[0]][arr[1]]['keyword'] = '';
          cscope.tapshow = iAttrs.tap;
          cscope[arr[0]].time = fac.time();
          cscope.$apply();
        });
      }
    };
  }]);
  //公共指令点击筛选
  app.directive('selectrun', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var arr = iAttrs.selectrun.split('.');
          cscope[arr[0]][arr[1]][arr[2]] = iAttrs.value;
          cscope[arr[0]].time = fac.time();
          cscope.$apply();
        });
      }
    };
  }]);
  app.directive('ysnoterun', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var arr = iAttrs.ysnoterun.split('.');
          cscope[arr[0]][arr[1]][arr[2]] = $scope.value['note'];
          cscope.tapshow = iAttrs.tap;
          cscope[arr[0]].time = fac.time();
          cscope.$apply();
        });
      }
    };
  }]);
  app.directive('tapshowupload', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope.tapshow = iAttrs.tapshowupload;
          var arr = iAttrs.savekey.split('.');
          $list = $('#thelist'),
            $btn = $('#ctlBtn'),
            state = 'pending';
          var obj = cscope[arr[0]][arr[1]];
          var key = arr[2];
          fac.webupload($list, $btn, state, obj, key, cscope, iAttrs.more);
          // YS("ueditor", function() {
            UE.getEditor('editor');

            setTimeout(function() {
              UE.getEditor('editor').destroy();
              UE.getEditor('editor');
            }, 500);

          // });
debugger;
          cscope.$apply();
        });
      }
    };
  }]);
  //公共方法初始化输入框
  app.directive('chushishu', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          // YS("ueditor", function() {
            UE.getEditor('editor');
            setTimeout(function() {
              UE.getEditor('editor').destroy();
              UE.getEditor('editor');
            }, 1);
          // });
        });
      }
    };
  }]);
  app.directive('delimg', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var arr = iAttrs.delimg.split('.');
          var keyarr = arr[2] + 'arr';
          cscope[arr[0]][arr[1]][keyarr].splice($scope.$index, 1);
          var a = cscope[arr[0]][arr[1]][keyarr].map(function(elem) {
            return elem;
          });
          cscope[arr[0]][arr[1]][arr[2]] = a.join(',');
          cscope.$apply();
        });
      }
    };
  }]);
  app.directive('delimg2', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var arr = iAttrs.delimg2.split('.');
          var key = arr[2];
          var key1 = '#' + iAttrs.key1;
          var key2 = '#' + iAttrs.key2;
          cscope[arr[0]][arr[1]][key] = '';
          $(key1).addClass('none');
          $(key2).addClass('none');
          cscope.$apply();
        });
      }
    };
  }]);
  app.directive('delimg3', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var arr = iAttrs.delimg3.split('.');
          var keyarr = arr[2] + 'arr';
          cscope[arr[0]][arr[1]][keyarr].splice($scope.$index, 1);
          var a = cscope[arr[0]][arr[1]][keyarr].map(function(elem) {
            return elem;
          });
          cscope[arr[0]][arr[1]][arr[2]] = a.join(',');
          var filearr = iAttrs.delkey + 'arr';
          cscope[arr[0]][arr[1]][filearr].splice($scope.$index, 1);
          var b = cscope[arr[0]][arr[1]][filearr].map(function(elem) {
            return elem;
          });
          cscope[arr[0]][arr[1]][iAttrs.delkey] = b.join(',');
          cscope.$apply();
        });
      }
    };
  }]);
  //修改后可用于当前页单个字段单个图片或多个上传
  app.directive('tapshowupload2', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope.tapshow = iAttrs.tapshowupload2;
          cscope.$apply();
          var arr = iAttrs.savekey.split('.');
          $list = $('#thelist'),
            $btn = $('#ctlBtn'),
            state = 'pending';
          var obj = cscope[arr[0]][arr[1]];
          var key = arr[2];
          fac.webupload($list, $btn, state, obj, key, cscope, iAttrs.more);
        });
      }
    };
  }]);
  //修改后可用于当前页多个字段图片上传
  app.directive('tapshowupload3', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope.tapshow = iAttrs.tapshowupload3;
          cscope.$apply();
          var arr = iAttrs.savekey.split('.');
          $list = $('#thelist'),
            $btn = $('#ctlBtn'),
            state = 'pending';
          var obj = cscope[arr[0]][arr[1]];
          var key = 1;
          var more = 1;
          fac.webupload($list, $btn, state, obj, key, cscope, more);
        });
      }
    };
  }]);
  //修改后可用于当前页单个字段单个图片或多个上传
  app.directive('mkshowupload', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope.mk2 = iAttrs.mkshowupload;
          cscope.$apply();
          var arr = iAttrs.savekey.split('.');
          $list = $('#thelist'),
            $btn = $('#ctlBtn'),
            state = 'pending';
          var obj = cscope[arr[0]][arr[1]];
          var key = arr[2];
          fac.webupload($list, $btn, state, obj, key, cscope, iAttrs.more);
        });
      }
    };
  }]);
  //修改后可用于当前页多个字段图片上传
  app.directive('toggshowupload', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope.toggshow = iAttrs.toggshowupload;
          cscope.$apply();
          var arr = iAttrs.savekey.split('.');
          $list = $('#thelist'),
            $btn = $('#ctlBtn'),
            state = 'pending';
          var obj = cscope[arr[0]][arr[1]];
          var key = 1;
          var more = 1;
          fac.webupload($list, $btn, state, obj, key, cscope, more);
        });
      }
    };
  }]);
  //用于拿到存储在本地的upimg
  app.directive('pickerrun', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var upimg = fac.getstore('upimg');
          fac.setstore('hash', fac.hashtoobj(upimg));
        });
      }
    };
  }]);
  //公共当前页编辑
  app.directive('updatepage', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("change", function(e) {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var arr = iAttrs.updatepage.split('.');
          var theid = iAttrs.key;
          cscope[arr[0]][arr[1]][theid] = $scope.value[theid];
          cscope[arr[0]][arr[1]][arr[2]] = $(iElm).val();
          $scope.value[arr[2]] = $(iElm).val();
          cscope[arr[0]].time = fac.time();
          cscope.$apply();
        });
      }
    };
  }]);
  //公共当前页编辑加带审核原因
  app.directive('updateshenhe', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("change", function(e) {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var arr = iAttrs.updateshenhe.split('.');
          var theid = iAttrs.key;
          var thereason = iAttrs.reason || 'reason';
          cscope[arr[0]][arr[1]][theid] = $scope.value[theid];
          if ($(iElm).val() == '2') {
            layer.prompt({
              title: '审核不通过原因',
              formType: 2
            }, function(text, index) {
              if (text === '') {
                layer.msg('原因不能为空');
              } else {
                layer.close(index);
                cscope[arr[0]][arr[1]][arr[2]] = $(iElm).val();
                cscope[arr[0]][arr[1]][thereason] = text;
                $scope.value[arr[2]] = $(iElm).val();
                cscope[arr[0]].time = fac.time();
                cscope.$apply();
              }
            });
          } else {
            cscope[arr[0]][arr[1]][arr[2]] = $(iElm).val();
            $scope.value[arr[2]] = $(iElm).val();
            cscope[arr[0]].time = fac.time();
            cscope.$apply();
          }
        });
      }
    };
  }]);

  //公共当前页 发布  默认带 空的审核原因    hsl
  app.directive('updaterun', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var arr = iAttrs.updaterun.split('.');
          var theid = iAttrs.key;
          cscope[arr[0]][arr[1]][arr[2]] = iAttrs.value;
          $scope.value[arr[2]] = iAttrs.value;
          cscope[arr[0]].time = fac.time();
          cscope.$apply();
        });
      }
    };
  }]);


  //公共当前页 发布  默认带 空的审核原因    hsl
  app.directive('optionrun', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("mouseover", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var arr = iAttrs.optionrun.split('.');
          var theid = iAttrs.key;
          cscope[arr[0]][arr[1]][arr[2]] = iAttrs.value;
          $scope.value[arr[2]] = iAttrs.value;
          cscope[arr[0]].time = fac.time();
          cscope.$apply();
        });
      }
    };
  }]);
  //头像预览
  app.directive('changeimg', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("change", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var objUrl = fac.getObjectURL(this.files[0]);
          if (objUrl) {
            $('.basicinfortimg').find('img').attr("src", objUrl);
          }
          // $(iAttrs.element).ajaxSubmit({
          //     url:"/admin.php/index/upload?name="+,
          //     success: function(re) {
          //       cscope[iAttrs.changeimg].params[iAttrs.imgkey]=re.url;
          //       cscope.$apply();
          //     }
          // }); 
        });
      }
    };
  }]);

  //图片上传
  app.directive('imgupload', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("change", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          //对iAttrs。imgupload进行解析
          var arr = iAttrs.imgupload.split('.');
          $(iAttrs.formid).ajaxSubmit({
            success: function(re) {
              cscope[arr[0]][arr[1]][arr[2]] = re.data.pathurl;
              cscope.$apply();
            }
          });
        });
      }
    };
  }]);
  //私有头像上传
  app.directive('pimgupload', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("change", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          $(document).on('change', '.a-upload', function() {
            var filePath = $(this).val();
            if (filePath.indexOf("jpg") != -1 || filePath.indexOf("png") != -1) {
              var arr = iAttrs.pimgupload.split('.');
              $(iAttrs.formid).ajaxSubmit({
                url: 'http://newtemp.yushan.com/index.php/auth/formupload?token=' + fac.getstore('ystoken'),
                success: function(re) {
                  cscope[arr[0]][arr[1]][arr[2]] = re.data.pathurl;
                  cscope.$apply();
                  cscope.$apply();

                }
              });
            } else {
              layer.msg('请上传"jpg"或者"png"格式的文件');
              return false;
            }
          });

          //对iAttrs。imgupload进行解析

        });
      }
    };
  }]);
  //文件上传
  app.directive('fileupload', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("change", function() {
          alert(123);
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          //对iAttrs。imgupload进行解析
          var arr = iAttrs.fileupload.split('.');
          $(iAttrs.formid).ajaxSubmit({
            success: function(re) {
              cscope[arr[0]][arr[1]][arr[2]] = re.data.pathurl;
              cscope.$apply();
            }
          });
        });
      }
    };
  }]);


  //私有简历上传
  app.directive('resumeupload', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("change", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          $(document).on('change', '.a-upload', function() {
            var filePath = $(this).val();
            if (filePath.indexOf("jpg") != -1 || filePath.indexOf("pdf") != -1 || filePath.indexOf("doc") != -1 || filePath.indexOf("docx") != -1) {
              var arr = iAttrs.resumeupload.split('.');
              $(iAttrs.formid).ajaxSubmit({
                url: 'http://newtemp.yushan.com/index.php/auth/resumeupload?token=' + fac.getstore('ystoken'),
                success: function(re) {
                  cscope[arr[0]][arr[1]][arr[2]] = re.data.pathurl;
                  cscope[arr[0]][arr[1]]['attachmentname'] = re.data.filename;
                  cscope.com_list2.data.attachmentname = re.filename;
                  cscope.com_list2.time = fac.time;
                  cscope.$apply();

                }
              });
            } else {
              layer.msg('您上传文件类型有误！请重新上传');
              return false;
            }
          });

          //对iAttrs。imgupload进行解析

        });
      }
    };
  }]);

  //私有方法
  app.directive('chkpowitem', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var t = $(iElm).is(':checked');
          $(iElm).parent().parent().parent().find('input').prop('checked', t);
        });
      }
    };
  }]);


  //公共当前页 发布  默认带 空的审核原因    fxx 触发getchat接口
  app.directive('yschatrun', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope[iAttrs.yschatrun].params.touserid = iAttrs.touserid;
          cscope[iAttrs.yschatrun].time = fac.time();
          cscope.$apply();
        });
      }
    };
  }]);
  //发送聊天记录
  app.directive('yssendmsg', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var input = $.trim($('#editor').val());
          var chattype = iAttrs.chattype;
          if (input == '' && chattype == 1) {
            layer.tips('请输入内容', '#send');
            return false;

          } //如果内容为空，发送内容失败
          var mine = {
            "nickname": user1.nickname,
            uid: user1.id,
            "content": input,
            "filetype": 0,
            "chattype": chattype,
            "avatar": user1.avatar,
            "jobid": user1.jobid,
            "note": user1.note,
            "reason": user1.reason
          };
          var to = {
            "nickname": user2.nickname,
            uid: user2.id,
            "type": "privateChat",
            "chattype": chattype,
            "avatar": user2.avatar
          };
          var login_data = fac.setMessage("chatMessage", mine, to);
          cscope.socket.send(login_data);
          $('#editor').val('');
          $("#editor").focus();
        });
      }
    };
  }]);
  //关闭表情发送
  app.directive('closeface', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          $('#facebox').hide();
        });
      }
    };
  }]);
  //开启表情发送
  app.directive('clickface', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          $('#facebox').show();
        });
      }
    };
  }]);
  //输入框点击
  app.directive('clickinput', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("focus", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          url = '#' + iAttrs.id;
          $(url).attr('placeholder', '');
        });
      }
    };
  }]);
  //输入框离开
  app.directive('moveinput', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("blur", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var key = iAttrs.placeholder;
          url = '#' + iAttrs.id;
          $(url).attr('placeholder', key);
        });
      }
    };
  }]);
  /*私有方法*/
  // 简历添加
  app.directive('ysadd', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        $scope.nadd = 0;
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope[iAttrs.ysadd].params = {};
          cscope[iAttrs.ysadd].type = iAttrs.type;
          cscope[iAttrs.ysadd].params.type = iAttrs.type;
          cscope.$apply();
        });
      }
    };
  }]);
  // 获取选项省份id
  app.directive('getcity', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("mouseover", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope.nowcity = [];
          cscope.com_list2.data.map(function(el) {
            if (el.pid == iAttrs.getcity) {

              cscope.nowcity.push(el);
            }
          });
          $scope.$apply();
        });
      }
    };
  }]);

  // 获取选项职位id
  app.directive('getjobtype', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("mouseover", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          cscope.thejob = [];
          cscope.com_list.data.map(function(e) {
            if (e.pid == iAttrs.getjobtype) {
              cscope.thejob.push(e);
            }
          });
          $scope.$apply();
        });
      }
    };
  }]);
  // 获取选项职位
  app.directive('getjobname', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var jobid = iAttrs.val;
          cscope.com_list.data.map(function(a) {
            if (a.id == jobid) {
              cscope.com_editadd.params.trade_cn = a.categoryname;
              $('.resume-job-type').find('ul').css('display', 'none');
            }
          });
          $scope.$apply();
        });
      }
    };
  }]);
  // 获取搜索关键词
  app.directive('getkw', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var keyword = $scope.keyword;
          var hrefx = window.location.href.split('?');
          var has = fac.getstore('hash');
          var o = iAttrs.getkw;
          var newu = o + '=' + keyword;
          if (!has) {
            newu = hrefx[0] + '?' + newu;
            window.location.href = newu;
          } else {
            var arr = [];
            var t = false;

            for (key in has) {
              var str = key + '=' + has[key];
              if (key == o) {
                t = true;
                str = key + '=' + keyword;
              }
              arr.push(str);
            }
            if (!t) {
              arr.push(newu);
            }
            var u = arr.join('&');
            window.location.href = hrefx[0] + '?' + u;
          }

          $scope.$apply();
        });
      }
    };
  }]);


  // 首页选项获取ID拼接地址
  app.directive('setlocalurl', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var allid = iAttrs.setlocalurl;
          var ke = $scope.keyword;
          cscope.com_list5.params['cid'] = $scope.value.c_id;
          var jid = iAttrs.val;
          var newurl = allid + '=' + jid;
          var gethash = fac.getstore('hash');
          var hrefx = window.location.href.split('?');
          if (gethash == '') {
            newurl = hrefx[0] + '?' + newurl;
            window.location.href = newurl;
          } else {
            // 如果输入框没有内容，删除hash里的keword
            if (ke == '') {
              delete gethash.keyword;
              var arr = [];
              var t = false;
              for (key in gethash) {
                var str = key + '=' + gethash[key];
                if (key == allid) {
                  t = true;
                  str = key + '=' + jid;
                }
                arr.push(str);
              }
              if (!t) {
                arr.push(newurl);
              }
              var u = arr.join('&');
              window.location.href = hrefx[0] + '?' + u;

            } else {
              var arr = [];
              var t = false;
              for (key in gethash) {
                var str = key + '=' + gethash[key];
                if (key == allid) {
                  t = true;
                  str = key + '=' + jid;
                }
                arr.push(str);
              }
              if (!t) {
                arr.push(newurl);
              }
              var u = arr.join('&');
              window.location.href = hrefx[0] + '?' + u;
            }

          }

          $scope.$apply();
        });

      }
    };
  }]);

  // 首页列表选择城市找对应的省份
  app.directive('setcyprurl', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var allid = iAttrs.setcyprurl;
          var jid = iAttrs.val;
          var newurl = allid + '=' + jid;
          var gethash = fac.getstore('hash');
          var ke = $scope.keyword;
          var hrefx = window.location.href.split('?');

          // 单独选择城市需要把对应pid找出         
          cscope.com_list2.data.map(function(e) {
            var propid = '';
            if (jid == e.cityid) {
              propid = e.pid;
              if (!ke) {
                window.location.href = hrefx[0] + '?' + allid + '=' + jid + '&' + 'province' + '=' + propid;
              } else {
                window.location.href = hrefx[0] + '?' + allid + '=' + jid + '&' + 'province' + '=' + propid + '&' + 'keyword' + '=' + ke;
              }

            }
          });
          $scope.$apply();
        });

      }
    };
  }]);
  // 首页列表选择省份找第一个城市
  app.directive('setprovrurl', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var allid = iAttrs.setprovrurl;
          var jid = iAttrs.val;
          var newurl = allid + '=' + jid;
          var gethash = fac.getstore('hash');
          var ke = $scope.keyword;
          var hrefx = window.location.href.split('?');
          var arr = []; //push城市
          var ara = []; //push城市id
          // 单独选择省份需要把省会城市找出         
          cscope.com_list2.data.map(function(e) {
            // var propid = '';       
            if (jid == e.pid) {

              arr.push(e.city);
              ara.push(e.cityid);
              cscope.cityname = arr[0]; //获取第一个城市
              var propid = ara[0]; //获取第一个城市id
              if (!ke) {
                window.location.href = hrefx[0] + '?' + allid + '=' + jid + '&' + 'city' + '=' + propid;
              } else {
                window.location.href = hrefx[0] + '?' + allid + '=' + jid + '&' + 'city' + '=' + propid + '&' + 'keyword' + '=' + ke;
              }

            }
          });
          $scope.$apply();
        });

      }
    };
  }]);
  // 选择省份不限移除省份和城市参数拼接地址
  app.directive('delpro', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var nowhash = fac.getstore('hash');
          var hrefx = window.location.href.split('?');
          var k = iAttrs.delpro;
          if (nowhash != null && nowhash[k] != undefined) {
            delete nowhash[k];
            delete nowhash.city;
            fac.setstore('hash', nowhash);
            var arr = [];
            for (k in nowhash) {
              var str = k + '=' + nowhash[k];
              arr.push(str);
            }
            var u = arr.join('&');
            window.location.href = hrefx[0] + '?' + u;
          }

          $scope.$apply();
        });

      }
    };
  }]);



  // 选择不限移除参数拼接地址
  app.directive('delthis', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var cscope = fac.getscope_byid($scope, $scope.yscid);
          var nowhash = fac.getstore('hash');
          var hrefx = window.location.href.split('?');
          var k = iAttrs.delthis;
          if (nowhash != null && nowhash[k] != undefined) {
            delete nowhash[k];
            fac.setstore('hash', nowhash);
            var arr = [];
            for (k in nowhash) {
              var str = k + '=' + nowhash[k];
              arr.push(str);
            }
            var u = arr.join('&');
            window.location.href = hrefx[0] + '?' + u;
          }

          $scope.$apply();
        });

      }
    };
  }]);
  // 找回密码
  app.directive('findpsword', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          setTimeout(function() {
            layer.open({

              type: 1,
              title: false, //不显示标题栏
              closeBtn: false,
              shade: 0.8,
              id: 'LAY_layuipro',
              resize: false,
              btnAlign: 'c',
              area: ['434px', '402px'], //宽高
              moveType: 1, //拖拽模式，0或者1
              shade: false,
              content: $('.forget-box')

            });
          }, 300);
          $scope.$apply();
        });

      }
    };
  }]);
  // 找回密码
  app.directive('rightornot', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var username = $scope.username;
          var captcha = $scope.captcha;
          var code = $scope.code;
          var a = $scope.passwordone;
          var b = $scope.passwordtwo;
          var tel = fac.testphone(username);
          if (username == undefined) {
            layer.msg('请输入手机号码');
          } else {
            if (!tel) {
              layer.msg('请输入正确的手机号码');
            } else {
              if (!captcha) {
                layer.msg('请输入验证码');
              } else {
                if (!code) {
                  layer.msg('请输入手机验证码');
                } else {
                  if (!a || !b) {
                    layer.msg('密码不能为空');
                  } else {
                    if (a.length < 6 || 16 < a.length || b.length < 6 || 16 < b.length) {
                      layer.msg('请输入6-16位密码');
                    } else {
                      if (a !== b) {
                        layer.msg('输入两次密码不一致');
                      } else {
                        var sendData = {
                          username: username,
                          password: a,
                          code: code
                        };
                        $.ajax({
                          url: 'http://newtemp.yushan.com/index.php/base/find_pass',
                          type: "POST",
                          xhrFields: {
                            withCredentials: true
                          },
                          data: sendData,
                          success: function(u) {
                            if (u.code == 1) {
                              layer.msg('修改成功,正在跳转');
                              setTimeout(function() {
                                layer.closeAll();
                              }, 1500);
                            } else {
                              layer.msg(u.msg);

                            }
                            $('#captchahit').attr('src', 'http://newtemp.yushan.com/index.php/Base/verify?timestamp=' + Date.parse(new Date()));
                          }
                        });
                      }
                    }
                  }
                }
              }
            }
          }
          $scope.$apply();
        });

      }
    };
  }]);

  // 注册框
  app.directive('registerbox', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          layer.closeAll();
          setTimeout(function() {
            layer.open({
              type: 1,
              title: false, //不显示标题栏
              closeBtn: false,
              shade: 0.8,
              id: 'LAY_layuipro',
              resize: false,
              btnAlign: 'c',
              area: ['736px', '408px'], //宽高
              moveType: 1, //拖拽模式，0或者1
              shade: false,
              content: $('.register-box')
            });
          }, 200);

        });
      }
    };
  }]);

  // 注册成功
  app.directive('zcscuuess', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          layer.open({
            type: 1,
            title: false, //不显示标题栏
            closeBtn: false,
            shade: 0.8,
            id: 'LAY_layuipro',
            resize: false,
            btnAlign: 'c',
            area: ['435px', '150px'], //宽高
            moveType: 1, //拖拽模式，0或者1
            shade: false,
            content: $('.zc-scuuess'),
            success: function(layero) {
              window.setTimeout(" window.location.reload(); ", 3000);
            }
          });
        });
      }
    };
  }]);
  // 注册
  app.directive('enroll', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var mscope = fac.getscope_byid($scope, $scope.ysmid);
          var username = $scope.username;
          var password = $scope.password;
          var code = $scope.code;
          var captcha = $scope.captcha;
          var xycheckbox = $scope.xycheckbox;
          var sendData = {
            username: username,
            password: password,
            captcha: captcha,
            code: code
          };
          // 判断手机
          var tel = fac.testphone(username);
          if (username == undefined) {
            layer.msg('请输入手机号码');
          } else {
            // 手机号11位与1开头
            if (!tel) {
              layer.msg('请输入正确的手机号码');
            } else {
              if (captcha == undefined) {
                layer.msg('请输入验证码');
              } else {
                if (code == undefined) {
                  layer.msg('请输入短信验证码');
                } else {
                  if (password == undefined || password.length < 6 || password.length > 16) {
                    layer.msg('请输入6-16位密码');
                  } else {
                    // 判断复选框
                    if (xycheckbox !== true) {
                      layer.msg('您还没阅读《宇杉协议》');
                    } else {
                      $.ajax({
                        url: 'http://newtemp.yushan.com/index.php/base/u_register',
                        type: "POST",
                        xhrFields: {
                          withCredentials: true
                        },
                        data: sendData,
                        success: function(u) {
                          if (u.code == 1) {
                            layer.msg('注册成功,正在跳转');
                            localStorage.setItem('ystoken', u.token);
                            localStorage.setItem('uuid', u.uuid);
                            setTimeout(function() {
                              layer.closeAll();
                              mscope.we = 1;
                              mscope.$apply();
                            }, 1500);
                          } else {
                            layer.msg('该用户已注册,请您直接登录');
                            setTimeout(function() {
                              layer.closeAll();
                            }, 800);
                            setTimeout(function() {
                              layer.open({
                                type: 1,
                                title: false, //不显示标题栏
                                closeBtn: false,
                                shade: 0.8,
                                id: 'LAY_layuipro',
                                resize: false,
                                btnAlign: 'c',
                                area: ['738px', '364px'], //宽高
                                moveType: 1, //拖拽模式，0或者1
                                shade: false,
                                content: $('.login-box')
                              });
                            }, 1500);
                          }
                          $('#captchahit').attr('src', 'http://newtemp.yushan.com/index.php/Base/verify?timestamp=' + Date.parse(new Date()));
                        }
                      });
                    }
                  }
                }
              }


            }

          }



        });
      }
    };
  }]);
  // 校验验证码
  app.directive('checkcode', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var captcha = $scope.captcha;
          var piccode = iAttrs.value;
          var username = $scope.username;
          var sendData = {
            username: username,
            check: 1,
            captcha: captcha
          };
          var tel = fac.testphone(username);
          if (username == undefined) {
            layer.msg('请输入手机号码');
          } else {
            if (!tel) {
              layer.msg('请输入正确的手机号码');
            } else {
              if (!captcha) {
                layer.msg('请输入验证码');
              } else {
                $.ajax({
                  url: 'http://newtemp.yushan.com/index.php/base/getphoneverifycode',
                  type: "POST",
                  xhrFields: {
                    withCredentials: true
                  },
                  data: sendData,
                  success: function(u) {
                    if (u.code == 1) {
                      layer.msg('验证码已发送');
                      var st = 59;
                      $('.ipt').val('发送验证码');
                      var sese = setInterval(function() {
                        if (st > 1) {
                          $('.ipt').addClass('color_8f');
                          $('.ipt').attr('disabled', true);
                          st = ~~st - 1;
                          $('.ipt').val('重新发送' + '(' + st + ')');
                        } else {
                          $('.ipt').val('发送验证码');
                          clearInterval(sese);
                          $('.ipt').addClass('color_blue');
                          $('.ipt').attr('disabled', false);
                        }

                      }, 1000);
                    } else {
                      layer.msg(u.msg);
                    }


                  }
                });
                // 倒计时60s                                

              }
            }
          }

        });
      }
    };
  }]);


  // 点击下载附件简历
  app.directive('downpage', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          window.open(iAttrs.downpage);
        });
      }
    };
  }]);


  // 点击刷新页面
  app.directive('refresh', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          window.location.reload();
        });
      }
    };
  }]);



  // 登录框
  app.directive('loginbox', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          window.lg == null ? fac.lginbox() : '';
        });
      }
    };
  }]);


  app.directive('lgnull', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {

          window.lg = null;
        });
      }
    };
  }]);
  // 登录按钮
  app.directive('loginbt', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var mscope = fac.getscope_byid($scope, $scope.ysmid);

          var a = $('#username').val();
          var b = $('#password').val();
          var c = $('#captcha').val();
          var sendData = {
            username: a,
            password: b,
            captcha: c
          };
          $.ajax({
            url: 'http://newtemp.yushan.com/index.php/Base/login',
            type: "POST",
            xhrFields: {
              withCredentials: true
            },
            data: sendData,
            success: function(h) {
              if (h.code == 1) {
                layer.msg('系统登录中…');
                localStorage.setItem('ystoken', h.token);
                localStorage.setItem('uuid', h.uuid);
                mscope.we = 1;
                mscope.$apply();
                setTimeout(function() {
                  layer.closeAll();
                }, 1000);
              } else {
                $('#tip').html(h.msg);
              }
              $('#captchahit').attr('src', 'http://newtemp.yushan.com/index.php/Base/verify?timestamp=' + Date.parse(new Date()));
            }
          });

        });
      }
    };
  }]);


  // 验证码登录按钮
  app.directive('loginphbt', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var mscope = fac.getscope_byid($scope, $scope.ysmid);
          var username = $scope.username;
          var code = $scope.code;
          var sendData = {
            username: username,
            code: code
          };
          var tel = fac.testphone(username);
          if (!tel) {
            layer.msg('请输入正确的手机号码');
          } else {
            if (code == undefined) {
              layer.msg('请输入验证码');
            } else {
              $.ajax({
                url: 'http://newtemp.yushan.com/index.php/base/phone_login',
                type: "POST",
                xhrFields: {
                  withCredentials: true
                },
                data: sendData,
                success: function(h) {
                  if (h.code == 1) {
                    layer.msg('系统登录中…');
                    localStorage.setItem('ystoken', h.token);
                    localStorage.setItem('uuid', h.uuid);
                    setTimeout(function() {
                      layer.closeAll();
                      mscope.we = 1;
                      mscope.$apply();
                    }, 1000);
                  } else {
                    layer.msg(h.msg);
                  }
                  $('#captchahit').attr('src', 'http://newtemp.yushan.com/index.php/Base/verify?timestamp=' + Date.parse(new Date()));
                }
              });
            }
          }


        });
      }
    };
  }]);
  // 登录校验验证码
  app.directive('loginckcode', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          var code = $scope.code;
          var piccode = iAttrs.value;
          var username = $scope.username;
          var sentipt = iAttrs;
          var sendData = {
            username: username,
            code: code
          };
          var tel = fac.testphone(username);
          if (!tel) {
            layer.msg('请输入正确的手机号码');
          } else {
            // 倒计时60s                                
            var st = 59;
            $(this).val('发送验证码');
            var _this = this;
            var sese = setInterval(function() {
              if (st > 1) {
                $(_this).addClass('color_8f');
                $(_this).attr('disabled', true);
                st = ~~st - 1;
                $(_this).val('重新发送' + '(' + st + ')');
              } else {
                $(_this).val('发送验证码');
                clearInterval(sese);
                $(_this).addClass('color_blue');
                $(_this).attr('disabled', false);
              }

            }, 1000);
            $.ajax({
              url: 'http://newtemp.yushan.com/index.php/base/getphoneverifycode',
              type: "POST",
              xhrFields: {
                withCredentials: true
              },
              data: sendData,
              success: function(u) {
                if (u.code == 1) {

                  layer.msg('验证码已发送');
                } else {
                  layer.msg('验证码发送失败');
                }


              }
            });


          }


        });
      }
    };
  }]);
  //4. rander_fac 处理函数（就是请求接口前后做的事情[默认不做]）
  app.factory('hdl', ['fac', function(fac) {
    var dosomething = {
      index: {
        init: function(sco) {
          $(document).ready(function() {
            setTimeout(function() {
              var swiper = new Swiper('.swiper-container', {
                pagination: '.swiper-pagination',
                paginationClickable: true,
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev',
                autoHeight: true,
              });
            }, 1500);
          });
          sco.com_list.params.codeid = fac.getcd(sco, 'c1');
          sco.com_list.params.diarytype = 1;
          sco.com_list.params.top = 3;
          sco.com_list.params.orderstrid = 2;
          sco.com_list.time = fac.time();
          sco.com_list.done = function(re, sco) {
            for (var i = re.data.length - 1; i >= 0; i--) {
              if (re.data[i]['content'].length > 12) {
                re.data[i]['content'] = re.data[i]['content'].substr(0, 12) + '...';
              }
            } //已限制字数12
          };
          sco.com_list2.params.codeid = fac.getcd(sco, 'c1');
          sco.com_list2.params.diarytype = 2;
          sco.com_list2.params.top = 3;
          sco.com_list2.params.orderstrid = 2;
          sco.com_list2.time = fac.time();
          sco.com_list2.done = function(re, sco) {
            for (var i = re.data.length - 1; i >= 0; i--) {
              if (re.data[i]['content'].length > 12) {
                re.data[i]['content'] = re.data[i]['content'].substr(0, 12) + '...';
              }
            } //已限制字数12
          };
          sco.com_list3.params.codeid = fac.getcd(sco, 'c1');
          sco.com_list3.params.diarytype = 3;
          sco.com_list3.params.top = 3;
          sco.com_list3.params.orderstrid = 2;
          sco.com_list3.time = fac.time();
          sco.com_list3.done = function(re, sco) {
            for (var i = re.data.length - 1; i >= 0; i--) {
              if (re.data[i]['content'].length > 12) {
                re.data[i]['content'] = re.data[i]['content'].substr(0, 12) + '...';
              }
            } //已限制字数12
          };
          sco.com_list4.url = 'auth/com_list';
          sco.com_list4.params = {
            "codeid": fac.getcd(sco, 'c5'),
            "c_alias": "QS_diary",
            "orderstrid": 3
          };
          sco.com_list4.time = fac.time();
          sco.com_list4.done = function(re, sco) {
            var i = 0;
            var k = 0;
            sco.tArray = new Array();
            sco.tArray[k] = [];
            for (var j = 0; j < re.data.length; j++) {
              sco.tArray[k].push(re.data[j]);
              i = i + 1;
              if (i == 6 && re.data.length != (j + 1)) {
                i = 0;
                k = k + 1;
                sco.tArray[k] = [];
              }
            }
          };
          sco.com_detail.url = 'auth/beijing_detail';
          sco.com_detail.params.codeid = fac.getcd(sco, 'c1');
          sco.com_detail.time = fac.time();
        }
      },
      edit: {
        init: function(sco) {
          sco.com_detail.url = 'auth/self_info';
          sco.com_detail.time = fac.time();
          sco.com_editadd.url = "base/editper";
          sco.com_editadd.done = function(re, sco) {
            fac.dogoto(re, '#edit');
          };
        }
      },
      profile: {
        init: function(sco) {
          sco.com_detail.url = 'auth/self_info';
          sco.com_detail.time = fac.time();
          sco.com_detail.done = function(re, sco) {
            sco.com_editadd.params = re.data;
            sco.com_editadd.url = 'auth/self_info_update';
            sco.com_editadd.before = function(sco) {
              sco.com_editadd.params.city = $('#city').attr("pname") + $('#city').attr("cname");
            };
            sco.com_editadd.done = function(re, sco) {
              fac.dogoto(re, '#profile');
            };
          };
        }
      },
      contacts: {
        init: function(sco) {
          $(document).on('mouseover', ".enlarge", function() {
            $('.contact-box').each(function() {
              animationHover($(this), 'pulse');
            });
          });
          sco.com_list.url = 'auth/mycom_list';
          sco.com_list.params.codeid = fac.getcd(sco, 'c7');
          sco.com_list.time = fac.time();
          sco.com_list.done = function(re, sco) {};
          sco.com_editadd.url = 'auth/mycom_editadd';
          sco.com_editadd.before = function(sco) {
            if (sco.com_editadd.params.codeid == undefined) {
              sco.com_editadd.params.codeid = fac.getcd(sco, 'c7');
            }
            sco.com_editadd.params.city = $('#city').attr("pname") + $('#city').attr("cname");
          };
          sco.com_editadd.done = function(re, sco) {
            fac.dogoto(re, '#contacts');
          };
        }
      },
      diary: {
        init: function(sco) {
          sco.mk1 = 0; //批量管理切换
          sco.mk2 = 0; //摘要与列表
          sco.mk3 = 0; //管理分类隐藏显示
          sco.mk4 = 0; //添加分类输入框隐藏显示
          var inputcodearr = [];
          $(document).on('click', ".diaryul li", function() {
            inputcodearr = [];
          });
          $(document).on('click', "[name='incode2']", function() {
            var b = $(this).parent().parent().index();
            var t = $("[name='incode']").eq(b).find('input').is(':checked');
            if (t) {
              inputcodearr.push($(this).val());
            } else {
              for (var i = 0; i < inputcodearr.length; i++) {
                if ($(this).val() == inputcodearr[i]) {
                  inputcodearr.splice(b - 1, 1);
                }
              }
            }
          });
          $(document).on('click', "#ckeckAll", function() {
            var t = 0;
            for (var i = 0; i < $("[name='incode']").length; i++) {
              if ($("[name='incode']").eq(i).find('input').is(':checked')) {
                t += 1;
              }
            }
            if (t == $("[name='incode']").length) {
              $("[name='incode']").find('input').prop('checked', false);
              inputcodearr = [];
            } else {
              $("[name='incode']").find('input').prop('checked', true);
              $("#ckeckAll").prop('checked', true);
              for (var j = 0; j < $("[name='incode']").length; j++) {
                inputcodearr.push($("[name='incode']").eq(j).find('input').val());
              }
            }
          });
          sco.com_del2.before = function(sco) {
            var inputcode = inputcodearr.join(',');
            sco.com_del2.params.codeid = inputcode;
          };
          sco.com_del2.done = function(re, sco) {
            inputcodearr = [];
            if (re.code == 1) {
              fac.dogoto(re, '#diary');
            }
          };
          $(document).on('click', "#order-by-sel", function() {
            $('#order-by-sel').toggleClass('select_order');
            $('#order-by-sel').toggleClass('bor2');
            $('#order-by-mnu').toggle();
          }); //下拉时间排序等
          $(document).on('blur', "#order-by-sel", function() {
            setTimeout(function() {
              $('#order-by-sel').removeClass('select_order');
              $('#order-by-sel').removeClass('bor2');
              $('#order-by-mnu').hide();
            }, 200);
          }); //下拉时间排序等失去焦点时
          $(document).on('click', "#order-by-mnuul li", function() {
            var shijian = $(this).text();
            $('#order-by-sel').find('span').eq(0).text(shijian);
            var a = $(this).index();
            $('#order-by-mnuul li').find('a').removeClass('none');
            $('#order-by-mnuul li').eq(a).find('a').addClass('none');
          }); //点击切换下拉筛选
          $(document).on('focus', "#blog_search_text", function() {
            $('.mod_search').removeClass('bor2');
            $('.mod_search').removeClass('bg');
            $('#blog_search_text').removeClass('c_tx3');
            $('.mod_search').addClass('mt_5');
            $('.mod_search').addClass('mlmb_11');
            $('.mod_search').addClass('textinput_focus');
          }); //点击搜索框样式改变
          $(document).on('blur', "#blog_search_text", function() {
            $('.mod_search').addClass('bor2');
            $('.mod_search').addClass('bg');
            $('#blog_search_text').addClass('c_tx3');
            $('.mod_search').removeClass('mt_5');
            $('.mod_search').removeClass('mlmb_11');
            $('.mod_search').removeClass('textinput_focus');
          }); //松开搜索框样式改变
          $(document).on('click', "[name='d']", function() {
            layer.open({
              type: 1,
              title: '添加日志分类',
              area: ['380px', '147px'],
              offset: 'c', //具体配置参考：offset参数项
              content: '<div class="add_sort"><span>分类名称：</span><input type="text" placeholder="请输入分类"><span>（最多12个字母或6个汉字）</span></div>',
              btn: ['确定', '取消'],
              btnAlign: 't', //按钮居中
              yes: function() {
                sco.com_editadd2.params.c_name = $('.layui-layer-content').find('input').val();
                sco.com_editadd2.time = fac.time();
                sco.$apply();
                layer.closeAll();
              }
            });
          }); //弹框写文章分类
          $(document).on('click', "[name='e']", function() {
            var a = $(this).parent().parent().parent().parent().index();
            $("[name='incode']").eq(a).children('.layui-layer2').show();
            $("[name='incode']").eq(a).children('.qz_mask2').show();
          }); //弹框写文章分类
          $(document).on('click', "[name='close1']", function() {
            $(this).parent().parent().hide();
            $(this).parent().parent().next().hide();
          }); //弹框关闭写文章分类
          $(document).on('click', ".modify_type", function() {
            $('.mod_modify_type').toggle();
          }); //点击修改分类切换
          $(document).on('blur', ".modify_type", function() {
            setTimeout(function() {
              $('.mod_modify_type').hide();
            }, 200);
          }); //点击修改分类切换失去焦点
          $(document).on('click', ".arr_wrap", function() {
            var a = $(this).parent().parent().parent().index();
            var b = $('#listAreaul').children('li').eq(a).find('.list_op').hasClass('show_more_op');
            $('#listAreaul').children('li').find('.list_op').removeClass('show_more_op');
            if (b) {
              $('#listAreaul').children('li').eq(a).find('.list_op').removeClass('show_more_op');
            } else {
              $('#listAreaul').children('li').eq(a).find('.list_op').addClass('show_more_op');
            }
            var c = $('#listAreaul').children('li').eq(a).find('.mod_drop_op').css('display');
            $('#listAreaul').children('li').find('.mod_drop_op').hide();
            if (c == 'none') {
              $('#listAreaul').children('li').eq(a).find('.mod_drop_op').show();
            } else {
              $('#listAreaul').children('li').eq(a).find('.mod_drop_op').hide();
            }
            var d = $('#listAreaul').children('li').eq(a).find('.arr_wrap').hasClass('bg');
            $('#listAreaul').children('li').find('.arr_wrap').removeClass('bg');
            $('#listAreaul').children('li').find('.arr_wrap').removeClass('bor2');
            if (d) {
              $(this).removeClass('bg');
              $(this).removeClass('bor2');
            } else {
              $(this).addClass('bg');
              $(this).addClass('bor2');
            }
          }); //编辑下拉
          $(document).on('blur', ".arr_wrap", function() {
            var a = $(this).parent().parent().parent().index();
            setTimeout(function() {
              $('#listAreaul').children('li').eq(a).find('.list_op').removeClass('show_more_op');
              $('#listAreaul').children('li').eq(a).find('.mod_drop_op').hide();
              $('#listAreaul').children('li').eq(a).find('.arr_wrap').removeClass('bg');
              $('#listAreaul').children('li').eq(a).find('.arr_wrap').removeClass('bor2');
            }, 200);
          }); //编辑下拉失去焦点
          $(document).on('click', "[name='fenlei1']", function() {
            var a = $(this).parent().parent().index();
            $('#cateMgrDiv').children('li').find('.admin_normal').show();
            $('#cateMgrDiv').children('li').find('.admin_edit').hide();
            $('#cateMgrDiv').children('li').eq(a).find('.admin_normal').hide();
            $('#cateMgrDiv').children('li').eq(a).find('.admin_edit').show();
          }); //点击编辑显示输入框改变分类
          $(document).on('click', "[name='fenlei2']", function() {
            var a = $(this).parent().parent().index();
            $('#cateMgrDiv').children('li').eq(a).find('.admin_normal').show();
            $('#cateMgrDiv').children('li').eq(a).find('.admin_edit').hide();
          }); //点击编辑显示输入框关闭分类编辑
          $(document).on('click', "[name='fenlei3']", function() {
            $('#cateMgrDiv').children('li').last().find('input').val('');
          }); //点击编辑显示输入框关闭分类编辑
          $(document).on('click', "#cateList li", function() {
            sco.com_list_page.params.keyword = '';
            sco.com_list_page.params.begintime = '';
            sco.com_list_page.params.endtime = '';
            sco.com_list_page.params.diarystyle = fac.getstore('c_id');
            sco.com_list_page.time = fac.time();
            sco.$apply();
          }); //点击右侧分类栏
          $(document).on('click', "#blog_search_btn", function() {
            sco.mk3 = 0;
            sco.com_list_page.params.diarystyle = '';
            sco.com_list_page.time = fac.time();
            sco.$apply();
            $('#cateList').children('li').removeClass('bg3_hover2');
            $('#cateList').children('li').eq(0).addClass('bg3_hover2');
          }); //点击右侧搜索框
          $(document).on('click', ".diarybutton", function() {
            sco.mk3 = 0;
            sco.com_list_page.time = fac.time();
            sco.$apply();
          }); //点击右侧时间检索框
          sco.com_list_page.url = 'auth/mycom_list_page';
          sco.com_list_page.params.codeid = fac.getcd(sco, 'c1');
          sco.com_list_page.params.listnum = 15;
          sco.com_list_page.params.diarytype = 1;
          sco.com_list_page.params.format = 1;
          sco.com_list_page.params.orderstrid = 2;
          sco.com_list_page.time = fac.time();
          sco.com_list_page.before = function(sco) {
            if (!$('#jiansuo1').val()) {
              sco.com_list_page.params.begintime = '';
            }
            if (!$('#jiansuo2').val()) {
              sco.com_list_page.params.endtime = '';
            }
          };
          sco.com_list_page.done = function(re, sco) {
            sco.total = re.code;
            sco.com_list.url = 'auth/diary_list1'; //日记风格分类
            sco.com_list.params = {
              "codeid": fac.getcd(sco, 'c5'),
              "c_alias": "QS_diary",
              "orderstrid": 3,
              "diarytype": sco.com_list_page.params.diarytype
            };
            sco.com_list.time = fac.time();
            sco.com_list.done = function(re, sco) {
              sco.diarytotal = re.arr.total;
              if (sco.com_list_page.params.diarystyle) {
                setTimeout(function() {
                  var stylevalue = parseInt(sco.com_list_page.params.diarystyle);
                  $('#cateList').children('li').removeClass('bg3_hover2');
                  $('#cateList').children('li').eq(stylevalue).addClass('bg3_hover2');
                }, 1);
              } else {
                $('#cateList').children('li').removeClass('bg3_hover2');
                $('#cateList').children('li').eq(0).addClass('bg3_hover2');
              }
            }
            sco.com_editadd4.params.format = 1;
            sco.com_editadd4.params.diarytype = sco.com_list_page.params.diarytype;
            sco.com_editadd4.url = 'auth/mycom_editadd';
            sco.com_editadd4.before = function(sco) {
              if (sco.com_editadd4.params.codeid == undefined) {
                sco.com_editadd4.params.codeid = fac.getcd(sco, 'c1');
              }
              sco.com_editadd4.params.content = UE.getEditor('editor').getContent();
            };
            sco.com_editadd4.done = function(re, sco) {
              if (re.code == 1) {
                fac.dogoto(re, '#diary');
              }
            }; //日记编辑
          };
          sco.com_editadd.params.c_alias = "QS_diary";
          sco.com_editadd.before = function(sco) {
            if (sco.com_editadd.params.c_name.length > 12) {
              layer.msg('请调整类别名称长度');
              return false;
            }
          };
          sco.com_editadd.done = function(re, sco) {
            if (re.code == 1) {
              $('#cateMgrDiv').children('li').find('.admin_normal').show();
              $('#cateMgrDiv').children('li').find('.admin_edit').hide();
            }
          };
          sco.com_editadd2.params.c_alias = "QS_diary";
          sco.com_editadd2.before = function(sco) {
            if (sco.com_editadd2.params.codeid == undefined) {
              sco.com_editadd2.params.codeid = fac.getcd(sco, 'c5');
            }
            if (sco.com_editadd2.params.c_name.length > 12) {
              layer.msg('请调整类别名称长度');
              return false;
            }
          };
          sco.com_editadd2.done = function(re, sco) {
            if (re.code == 1) {
              sco.com_list.data.push(re.data);
              sco.mk4 = 0;
              sco.$apply();
            }
          };
          sco.com_editadd3.url = 'auth/diary_editadd';
          sco.com_editadd3.before = function(sco) {
            var inputcode = inputcodearr.join(',');
            sco.com_editadd3.params.codeid = inputcode;
          };
          sco.com_editadd3.done = function(re, sco) {
            inputcodearr = [];
            fac.dogoto(re, '#diary');
          };
          sco.com_editadd5.url = 'auth/diary_editadd';
          sco.com_editadd5.done = function(re, sco) {
            fac.dogoto(re, '#diary');
          };
        }
      },
      album: {
        init: function(sco) {
          sco.mk1 = 0; //新增相册切换
          sco.mk2 = 0; //图片上传
          sco.mk3 = 0; //图片上传
          sco.mk4 = 0; //图片放大
          $(document).ready(function() {
            $('.file-box').each(function() {
              animationHover(this, 'pulse');
            });
          });
          $(document).on('click', ".deleteimg", function() {
            if (sco.com_editadd.params.imgarr.length == 0) {
              $('.statusBar').addClass('none');
              $('#dndArea').removeClass('none');
              $('#filePicker').addClass('none');
            }
          }); //图片上传点击触发事件
          $(document).on('click', ".layui-layer-setwin", function() {
            sco.com_editadd.params.imgarr = [];
            sco.mk2 = 0;
            sco.$apply();
          }); //关闭图片上传清空参数值
          $(document).on('click', "[name='a']", function() {
            layer.open({
              type: 1,
              title: '添加日志分类',
              area: ['380px', '147px'],
              offset: 'c', //具体配置参考：offset参数项
              content: '<div class="add_sort"><span>分类名称：</span><input type="text" placeholder="请输入分类"><span>（最多12个字母或6个汉字）</span></div>',
              btn: ['确定', '取消'],
              btnAlign: 't', //按钮居中
              yes: function() {
                sco.com_editadd3.params.name = $('.layui-layer-content').find('input').val();
                sco.com_editadd3.url = 'auth/mycom_editadd';
                sco.com_editadd3.params.codeid = fac.getcd(sco, 'c9');
                sco.com_editadd3.time = fac.time();
                var newalbum = Array();
                sco.com_editadd3.done = function(re, sco) {
                  if (re.code == 1) {
                    newalbum['id'] = parseInt(re.data);
                    newalbum['name'] = sco.com_editadd3.params.name;
                    sco.com_list.data.push(newalbum);
                  }
                };
                sco.$apply();
                layer.closeAll();
              }
            });
          }); //弹框添加相册
          sco.com_list.url = 'auth/album_list1';
          sco.com_list.params = {
            "codeid": fac.getcd(sco, 'c9'),
            "orderstrid": 3
          };
          sco.com_list.time = fac.time(); //相册列表
          sco.com_list.done = function(re, sco) {
            if (re.code == 1) {
              for (var i = re.data.length - 1; i >= 0; i--) {
                if (re.data[i]['name'].length > 10) {
                  re.data[i]['name'] = re.data[i]['name'].substr(0, 10) + '...';
                }
              } //已限制字数10
              sco.com_list2.url = 'auth/mycom_list';
              sco.com_list2.params.codeid = fac.getcd(sco, 'c8');
              sco.com_list2.params.pid = re.data[0]['id'];
              sco.com_list2.params.orderstrid = 2;
              sco.com_list2.time = fac.time(); //相册内照片列表
              sco.com_list2.done = function(re, sco) {
                for (var i = 0; i < sco.com_list.data.length; i++) {
                  if (sco.com_list.data[i]['id'] == parseInt(sco.com_list2.params.pid)) {
                    $('#cateList').children('li').removeClass('bg3_hover2');
                    $('#cateList').children('li').eq(i + 1).addClass('bg3_hover2');
                  }
                }
                sco.com_editadd2.url = 'auth/album_editadd';
                sco.com_editadd2.params.pid = sco.com_list2.params.pid;
                sco.com_editadd2.done = function(re, sco) {
                  if (re.code == 1) {
                    fac.dogoto(re, '#album');
                  }
                };
              }
            }
          };
          sco.com_detail.done = function(re, sco) {
            if (re.code == 1) {
              sco.mk4 = 1;
            }
          };
          sco.com_editadd.url = 'auth/mycom_editadd';
          sco.com_editadd.params.codeid = fac.getcd(sco, 'c9');
          sco.com_editadd.done = function(re, sco) {
            if (re.code == 1) {
              fac.dogoto(re, '#album');
            }
          };
        }
      },
      video: {
        init: function(sco) {
          sco.mk1 = 0;
          $(document).on('mouseover', ".enlarge", function() {
            $('.contact-box2').each(function() {
              animationHover($(this), 'pulse');
            });
          });
          $(document).on('click', ".videoul li", function() {
            sco.com_editadd.params.content = '';
            sco.com_editadd.params.title = '';
            sco.com_editadd.params.thumb = '';
            $('#fileList1').addClass('none');
            $('#fileList2').addClass('none');
            $('#imgparams1').addClass('none');
            $('#imgparams2').addClass('none');
          }); //点击删除
          sco.com_list.url = 'auth/mycom_list';
          sco.com_list.params.codeid = fac.getcd(sco, 'c1');
          sco.com_list.params.format = 3;
          sco.com_list.time = fac.time();
          sco.com_detail.done = function(re, sco) {
            if (re.code == 1) {
              sco.mk1 = 1;
            }
          };
          sco.com_editadd.url = 'auth/mycom_editadd';
          sco.com_editadd.before = function(sco) {
            if (sco.com_editadd.params.codeid == undefined) {
              sco.com_editadd.params.codeid = fac.getcd(sco, 'c1');
            }
            sco.com_editadd.params.format = 3;
          };
          sco.com_editadd.done = function(re, sco) {
            fac.dogoto(re, '#video');
          };
        }
      },
      games: {
        init: function(sco) {
          $(document).on('click', "#cateList li", function() {
            var a = $(this).index();
            fac.setstore('game', a);
            window.location.reload();
          }); //点击切换游戏
          $(document).ready(function() {
            var a = fac.getstore('game');
            fac.setstore('game', '');
            $('#cateList').children('li').removeClass('bg3_hover2');
            $('#cateList').children('li').eq(a).addClass('bg3_hover2');
            $("[name='game']").addClass('none');
            $("[name='game']").eq(a).removeClass('none');
            setTimeout(function() {
              if (a == 0 || $.trim(a) == '') {
                //2048
                prepareForMobile();
                newgame();
                //2048
              }
              if (a == 1) {
                //英雄方块
                _bgExtName = "png";
                _UniTypeNumber = 6;
                $("#btnReset")
                  .bind("click", function() {
                    location.reload();
                  });
                $("#btnReset2")
                  .bind("click", function() {
                    location.reload();
                  });
                gameStart();
                //英雄方块
              }
            }, 100);
          });
          $(document).keydown(function(event) {
            event.preventDefault();
            switch (event.keyCode) {
              case 37: //left
                if (moveLeft()) {
                  setTimeout("generateOneNumber()", 210);
                  setTimeout("isgameover()", 300);
                }
                break;
              case 38: //up
                if (moveUp()) {
                  setTimeout("generateOneNumber()", 210);
                  setTimeout("isgameover()", 300);
                }
                break;
              case 39: //right
                if (moveRight()) {
                  setTimeout("generateOneNumber()", 210);
                  setTimeout("isgameover()", 300);
                }
                break;
              case 40: //down
                if (moveDown()) {
                  setTimeout("generateOneNumber()", 210);
                  setTimeout("isgameover()", 300);
                }
                break;
              default: //default
                break;
            }
          });
          document.addEventListener('touchstart', function(event) {
            startx = event.touches[0].pageX;
            starty = event.touches[0].pageY;
          });
          document.addEventListener('touchend', function(event) {
            endx = event.changedTouches[0].pageX;
            endy = event.changedTouches[0].pageY;
            var deltax = endx - startx;
            var deltay = endy - starty;
            if (Math.abs(deltax) < 0.3 * documentWidth && Math.abs(deltay) < 0.3 * documentWidth)
              return;
            if (Math.abs(deltax) >= Math.abs(deltay)) {
              if (deltax > 0) {
                //move right
                if (moveRight()) {
                  setTimeout("generateOneNumber()", 210);
                  setTimeout("isgameover()", 300);
                }
              } else {
                //move left
                if (moveLeft()) {
                  setTimeout("generateOneNumber()", 210);
                  setTimeout("isgameover()", 300);
                }
              }
            } else {
              if (deltay > 0) {
                //move down
                if (moveDown()) {
                  setTimeout("generateOneNumber()", 210);
                  setTimeout("isgameover()", 300);
                }
              } else {
                //move up
                if (moveUp()) {
                  setTimeout("generateOneNumber()", 210);
                  setTimeout("isgameover()", 300);
                }
              }
            }
          });
        }
      },
      music: {
        init: function(sco) {
          sco.mk1 = 0; //批量管理切换
          var inputcodearr = [];
          $(document).on('click', "[name='incode2']", function() {
            var b = $(this).parent().parent().index();
            var t = $("[name='incode']").eq(b).find('input').is(':checked');
            if (t) {
              inputcodearr.push($(this).val());
            } else {
              for (var i = 0; i < inputcodearr.length; i++) {
                if ($(this).val() == inputcodearr[i]) {
                  inputcodearr.splice(b - 1, 1);
                }
              }
            }
          });
          $(document).on('click', "#ckeckAll", function() {
            var t = 0;
            for (var i = 0; i < $("[name='incode']").length; i++) {
              if ($("[name='incode']").eq(i).find('input').is(':checked')) {
                t += 1;
              }
            }
            if (t == $("[name='incode']").length) {
              $("[name='incode']").find('input').prop('checked', false);
              inputcodearr = [];
            } else {
              $("[name='incode']").find('input').prop('checked', true);
              $("#ckeckAll").prop('checked', true);
              for (var j = 0; j < $("[name='incode']").length; j++) {
                inputcodearr.push($("[name='incode']").eq(j).find('input').val());
              }
            }
          });
          sco.com_del2.before = function(sco) {
            var inputcode = inputcodearr.join(',');
            sco.com_del2.params.codeid = inputcode;
          };
          sco.com_del2.done = function(re, sco) {
            inputcodearr = [];
            if (re.code == 1) {
              fac.dogoto(re, '#music');
            }
          };
          $(document).on('focus', "#blog_search_text", function() {
            $('.mod_search').removeClass('bor2');
            $('.mod_search').removeClass('bg');
            $('#blog_search_text').removeClass('c_tx3');
            $('.mod_search').addClass('mlmb_12');
            $('.mod_search').addClass('textinput_focus');
          }); //点击搜索框样式改变
          $(document).on('blur', "#blog_search_text", function() {
            $('.mod_search').addClass('bor2');
            $('.mod_search').addClass('bg');
            $('#blog_search_text').addClass('c_tx3');
            $('.mod_search').removeClass('mlmb_12');
            $('.mod_search').removeClass('textinput_focus');
          }); //松开搜索框样式改变
          $(document).on('click', ".arr_wrap", function() {
            var a = $(this).parent().parent().parent().index();
            var b = $('#listAreaul').children('li').eq(a).find('.list_op').hasClass('show_more_op');
            $('#listAreaul').children('li').find('.list_op').removeClass('show_more_op');
            if (b) {
              $('#listAreaul').children('li').eq(a).find('.list_op').removeClass('show_more_op');
            } else {
              $('#listAreaul').children('li').eq(a).find('.list_op').addClass('show_more_op');
            }
            var c = $('#listAreaul').children('li').eq(a).find('.mod_drop_op').css('display');
            $('#listAreaul').children('li').find('.mod_drop_op').hide();
            if (c == 'none') {
              $('#listAreaul').children('li').eq(a).find('.mod_drop_op').show();
            } else {
              $('#listAreaul').children('li').eq(a).find('.mod_drop_op').hide();
            }
            var d = $('#listAreaul').children('li').eq(a).find('.arr_wrap').hasClass('bg');
            $('#listAreaul').children('li').find('.arr_wrap').removeClass('bg');
            $('#listAreaul').children('li').find('.arr_wrap').removeClass('bor2');
            if (d) {
              $(this).removeClass('bg');
              $(this).removeClass('bor2');
            } else {
              $(this).addClass('bg');
              $(this).addClass('bor2');
            }
          }); //编辑下拉
          $(document).on('blur', ".arr_wrap", function() {
            var a = $(this).parent().parent().parent().index();
            setTimeout(function() {
              $('#listAreaul').children('li').eq(a).find('.list_op').removeClass('show_more_op');
              $('#listAreaul').children('li').eq(a).find('.mod_drop_op').hide();
              $('#listAreaul').children('li').eq(a).find('.arr_wrap').removeClass('bg');
              $('#listAreaul').children('li').eq(a).find('.arr_wrap').removeClass('bor2');
            }, 200);
          }); //编辑下拉失去焦点
          sco.com_list_page.url = 'auth/mycom_list_page';
          sco.com_list_page.params.codeid = fac.getcd(sco, 'c1');
          sco.com_list_page.params.listnum = 15;
          sco.com_list_page.params.format = 4;
          sco.com_list_page.params.orderstrid = 2;
          sco.com_list_page.time = fac.time();
          sco.com_list_page.done = function(re, sco) {
            sco.total = re.code;
            sco.com_editadd.params.format = 4;
            sco.com_editadd.url = 'auth/music_editadd';
            sco.com_editadd.before = function(sco) {
              if (sco.com_editadd.params.codeid == undefined) {
                sco.com_editadd.params.codeid = fac.getcd(sco, 'c1');
              }
              sco.com_editadd.params.format = 4;
            };
            sco.com_editadd.done = function(re, sco) {
              fac.dogoto(re, '#music');
            }; //音乐编辑
          };
        }
      },
      schedule: {
        init: function(sco) {
          sco.mk1 = 0;
          sco.schedulearray = [];
          sco.dropcode = '';
          $(document).ready(function() {
            setTimeout(function() {
              $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
              });
              /* initialize the calendar
               -----------------------------------------------------------------*/
              var date = new Date();
              var d = date.getDate();
              var m = date.getMonth();
              var y = date.getFullYear();
              $('#calendar').fullCalendar({
                header: {
                  left: 'prev,next',
                  center: 'title',
                  right: 'month,agendaWeek,agendaDay'
                },
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function(date, allDay) { // this function is called when something is dropped
                  // retrieve the dropped element's stored Event Object
                  var originalEventObject = $(this).data('eventObject');
                  // we need to copy it, so that multiple events don't have a reference to the same object
                  var copiedEventObject = $.extend({}, originalEventObject);
                  // assign it the date that was reported
                  copiedEventObject.start = date;
                  copiedEventObject.allDay = allDay;
                  var a = $(this).index();
                  if ($.trim(sco.schedulearray[a - 1]['end']) !== '' && parseInt(sco.schedulearray[a - 1]['end'])) {
                    var endnum = parseInt(sco.schedulearray[a - 1]['end']);
                  }
                  sco.com_editadd.url = 'auth/mycom_editadd';
                  sco.com_editadd.params.codeid = fac.getcd(sco, 'c2');
                  sco.com_editadd.params.title = $(this).data('eventObject')['title'];
                  sco.com_editadd.params.start = date;
                  if ($.trim(endnum) !== '') {
                    var d2 = date.getDate();
                    var m2 = date.getMonth();
                    var y2 = date.getFullYear();
                    copiedEventObject.end = new Date(y2, m2, d2 + endnum - 1);
                    sco.com_editadd.params.end = copiedEventObject.end;
                  }
                  sco.com_editadd.time = fac.time();
                  sco.com_editadd.done = function(re, sco) {
                    if (re.code == 1) {
                      sco.dropcode = re.data;
                    }
                  };
                  // render the event on the calendar
                  // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                  $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                  // is the "remove after drop" checkbox checked?
                  if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                  sco.schedulearray.splice(a - 1, 1);
                  }
                  sco.$apply();
                },
                eventDrop: function(event, dayDelta, minuteDelta, allDay, revertFunc, jsEvent, ui, view) {
                  sco.com_editadd2.url = 'auth/schedule_editadd';
                  if (event.codeid == undefined) {
                    sco.com_editadd2.params.dropcode = sco.dropcode;
                    sco.com_editadd2.params.codeid = '';
                  } else {
                    sco.com_editadd2.params.codeid = event.codeid;
                    sco.com_editadd2.params.dropcode = '';
                  }
                  sco.com_editadd2.params.title = event.title;
                  sco.com_editadd2.params.start = event.start;
                  if ($.trim(event.end) !== '') {
                    sco.com_editadd2.params.end = event.end;
                  }
                  if (allDay) {
                    sco.com_editadd2.params.allDay = 1;
                  } else {
                    sco.com_editadd2.params.allDay = 0;
                  }
                  sco.com_editadd2.time = fac.time();
                  sco.$apply();
                },
                events: sco.com_list.data,
              });
            }, 200);
            $(document).on('click', ".diarybutton", function() {
              var scheduleobj = new Object();
              scheduleobj = {
                title: $('#blog_search_text').val(),
                end: $('#blog_search_text2').val()
              };
              sco.schedulearray.push(scheduleobj);
              sco.mk1 = 0;
              sco.$apply();
              $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
              });
              /* initialize the external events
               -----------------------------------------------------------------*/
              $('#external-events div.external-event').each(function() {
                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                  title: $.trim($(this).text()) // use the element's text as the event title
                };
                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);
                // make the event draggable using jQuery UI
                $(this).draggable({
                  zIndex: 999,
                  revert: true, // will cause the event to go back to its
                  revertDuration: 0 //  original position after the drag
                });
              });
            }); //新增日程
            $(document).on('click', "#xinzeng", function() {
              $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
              });
            });
            sco.com_list.url = 'auth/mycom_list';
            sco.com_list.params.codeid = fac.getcd(sco, 'c2');
            sco.com_list.time = fac.time();
            sco.com_list.done = function(re, sco) {
              if (re.code == 1) {
                for (var i = re.data.length - 1; i >= 0; i--) {
                  re.data[i]['allDay'] = Boolean(re.data[i]['allDay']);
                }
              }
            };
          });
        }
      },
    };
    return dosomething;
  }]);
  // 存是哪一个类
  app.directive('settype', ['fac', function(fac) {
    return {
      link: function($scope, iElm, iAttrs, controller) {
        iElm.on("click", function() {
          fac.setstore('settype', iAttrs.settype);
        });
      }
    };
  }]);