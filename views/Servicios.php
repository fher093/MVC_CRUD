<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Basic CRUD Application - jQuery EasyUI CRUD Demo</title>
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/demo/demo.css">
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
</head>
<body>
    
    
    <table id="dg" title="Estudiantes" class="easyui-datagrid" style="width:700px;height:250px"
            url="models/select.php"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="estcedula" width="50">Cedula</th>
                <th field="estnombre" width="50">Nombre</th>
                <th field="estapellido" width="50">Apellido</th>
                <th field="estdireccion" width="50">Direccion</th>
                <th field="esttelefono" width="50">Telefono</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nuevo Estudiante</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar Usuario</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Eliminar Estudiante</a>
    <input id="txtBuscar" class="easyui-textbox" prompt="Ingrese la cédula" style="width:180px">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="buscarEstudiante()">Buscar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" plain="true" onclick="verTodos()">Ver todos</a>
    </div>
    
    <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>User Information</h3>
            <div style="margin-bottom:10px">
                <input name="estcedula" class="easyui-textbox" required="true" label="Cedula:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="estnombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="estapellido" class="easyui-textbox" required="true" label="Apellido:" style="width:100%">
            </div> 
            <div style="margin-bottom:10px">
                <input name="estdireccion" class="easyui-textbox" required="true" label="Direccion:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="esttelefono" class="easyui-textbox" required="true" label="Telefono:" style="width:100%">
            </div>
            
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
    </div>
    <script type="text/javascript">
        var url;
        function newUser(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','Nuevo Estudiante');
            $('#fm').form('clear');
            url = 'models/insert.php';
        }
        function editUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Editar Estudiante');
                $('#fm').form('load',row);
                url = 'models/update.php?estcedula='+row.estcedula;
            }
        }
        function saveUser(){
            $('#fm').form('submit',{
                url: url,
                iframe: false,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.errorMsg){
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dlg').dialog('close');        // close the dialog
                        $('#dg').datagrid('reload');    // reload the user data
                    }
                }
            });
        }
        function destroyUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirmar','Estas seguro de borrar al estudiante?',function(r){
                    if (r){
                        $.post('models/delete.php',{txtcedula:row.estcedula},function(result){
                            if (result.success){
                                $('#dg').datagrid('reload');    // reload the user data
                            } else {
                                $.messager.show({    // show error message
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        },'json');
                    }
                });
            }
        } 

        function buscarEstudiante(){
        var cedula = $('#txtBuscar').textbox('getValue').trim();
        if (cedula === ''){
            $.messager.alert('Aviso','Ingrese una cédula para buscar','warning');
            return;
        }
        $('#dg').datagrid('options').url = 'models/buscar.php';
        $('#dg').datagrid('load', {estcedula: cedula});
    }

    function verTodos(){
        $('#txtBuscar').textbox('clear');
        $('#dg').datagrid('options').url = 'models/select.php';
        $('#dg').datagrid('load', {});
    }
    </script>
</body>
</html>
