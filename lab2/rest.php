<?php
require('MySQLHandler.php');

$handler =new MySQLHandler('products');

$method=$_SERVER['REQUEST_METHOD'];

$url= $_SERVER['REQUEST_URI'];
$parts=explode('/',$url);

//resource
$resource=isset($parts[3])? $parts[3]:null;
//resourceid
$resourceId=isset($parts[4])? $parts[4]:null;

if($handler->connect()){
    if($resource == 'items'){
        switch($method){
            case 'GET':
                
                $getItemById=$handler->get_record_by_id($resourceId);
                 if(!$getItemById){
                        $getItemById= ['error'=>"Resource dosn't exist"];
                        http_response_code(404);
                    }
                else{
                        $getItemById= $getItemById[0];
                    }
                echo json_encode($getItemById);
                break;
            case 'POST':
                
                $newdata=json_decode(file_get_contents("php://input"),true);
                $handler->save($newdata);
                echo json_encode(["success"=>"item added successfully"]);
                break;
            case 'PUT':
                $updated_Id=$handler->get_record_by_id($resourceId);
                $handler->connect();
                if(!$updated_Id){
                    echo json_encode(['error'=>"Resource doesn't exist"]);
                        http_response_code(404);
                }
                else{
                $newdata=json_decode(file_get_contents("php://input"),true);
               
                $handler->update($newdata,$resourceId);
                echo json_encode(["success"=>"item updated successfully"]);
         
        }
                break;

            case 'DELETE':
                $Deleted_id=$handler->get_record_by_id($resourceId);
                $handler->connect();
                if($Deleted_id){
                    $handler->delete($resourceId);
                    echo json_encode(["success"=>"item deleted successfully"]);
                }
                else{
                    echo json_encode(["warning"=>"no such item"]);
                    http_response_code(404);
                }
                    break;
            default:
                echo json_encode(["error"=>"method not allowed!"]);
                http_response_code(405);
                break;
        }
    
    }
    else{
        $error= ['error'=>"Resource doesn't exist"];
        echo json_encode($error);
        http_response_code(404);
    }
    
}
 else{
    $error= ['error'=>"internal server error!"];
        echo json_encode($error);
        http_response_code(500);
 }

?>