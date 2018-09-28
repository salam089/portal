# HMVC Structure
#### Php 5.6, Modular approch, Organized ajax call, HMVC structure, Php Multiple inheritence with trait, Namespace


Single ajax/jason request processor function - "portal.include\ajax-handler.php" will handle all the ajax request, Php ajax processor have use "file_get_content('php://input')" to get/receive request and forward to processs it to its destination function) normal http requst is handle with the psttern of MVC modular approach(HMVC). You may get the http request process function -"portal/include/request-handler.php". Both "ajax/json" and "http" request are process with "portal/include/PostHandler.php". Passing unknown number of function param have used php .5.6 "call_user_func_array ($callback ,$param_arr )".
