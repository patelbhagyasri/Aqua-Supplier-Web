<?php
include_once('connection.php');
?>

												<?php
												
												if(isset($_POST['id']))
												{
													mysql_query("set names utf8");
													$resAreaClient=("select * from customer_master where truck_id='".$_POST['id']."'");
													$res=mysql_query($resAreaClient);
													?>
													<option value="">----Select Customer-----</option>
													<?php
													while($rowAClient=mysql_fetch_array($res))
													{
														?>
														
														<option value="<?php echo $rowAClient[0]; ?>"><?php echo $rowAClient[1]; ?></option>
															
														<?php
													}
													}
												?>