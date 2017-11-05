<?php 

	// Allow the config
	define('__CONFIG__', true);

	// Require the config
	require_once "../inc/config.php"; 

	if($_SERVER['REQUEST_METHOD'] == 'POST' or 1==1) {
		// Always return JSON format
		// header('Content-Type: application/json');

		$return = [];

		$email = $_POST['email'] ;
		$password = $_POST['password'] ;

        try  
        {                
            $tsql = "SELECT dbo.obtenerPermiso ('$email', '$password')";  
            $getProducts = sqlsrv_query($con, $tsql);  

			if( $getProducts === false ) {
			     die( print_r( sqlsrv_errors(), true));
			}

			// Make the first (and in this case, only) row of the result set available for reading.
			if( sqlsrv_fetch( $getProducts ) === false) {
			     die( print_r( sqlsrv_errors(), true));
			}

			// Get the row fields. Field indeces start at 0 and must be retrieved in order.
			// Retrieving row fields by name is not supported by sqlsrv_get_field.
			$name = sqlsrv_get_field( $getProducts, 0);

            if ($name == 1) { //Lo encontro.

				$return['redirect'] = 'php-login-secure-sqlfunc/dashboard.php?message=welcome';
				$return['is_logged_in'] = true;

				
			
			} else {
				//No lo encontro.
				$return['error'] = "Account doesn't exists";
				$return['is_logged_in'] = false;
			}

			sqlsrv_free_stmt($getProducts);  
            sqlsrv_close($con);  

			echo json_encode($return, JSON_PRETTY_PRINT); exit;

             
        }  
        catch(Exception $e)  
        {  
            echo("Error!");  
        }




		
	} else {
		// Die. Kill the script. Redirect the user. Do something regardless.
		exit('Invalid URL');
	}
?>
