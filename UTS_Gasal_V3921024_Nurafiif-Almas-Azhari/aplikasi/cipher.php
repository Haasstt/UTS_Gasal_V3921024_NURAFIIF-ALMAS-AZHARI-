<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">KRIPTOGRAFI KOMBINASI CAESAR & VIGENERE CIPHER</h1>
	
</div>

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-xl-8 col-lg-12 col-md-9">

  			<div class="card o-hidden border-0 shadow-lg my-3">
  			  <div class="card-body p-0">
      				<div class="row">
      				  <div class="col-lg-12">
      				    <div class="p-5">
      				      <div>
								<h1 class="h1 text-gray-900 mb-4 text-center font-weight-bold text-uppercase">Form Input</h1>       
                                <!--form input text dan key -->
								<form class="user" method="POST"> 
							        <div class="form-group">
								        <input id="username" type="text" name="input_text" class="form-control form-control-user" placeholder="Masukkan text" required>
							        </div>
							        <div class="form-group">
								        <input id="username" type="number" name="input_key_caesar" class="form-control form-control-user" placeholder="key caesar" required>
							        </div>
							        <div class="form-group">
								        <input id="username" type="text" name="input_key_vigenere" class="form-control form-control-user" placeholder="key vigenere" required>
							        </div>
								        <input type="submit" name="enkripsi" value="Enkripsi" class="btn btn-danger btn-user">
								        <input type="submit" name="deskripsi" value="Deskripsi" class="btn btn-success btn-user">
						        </form>
							    <hr>
									<h1 class="h4 text-gray-900 mb-4 text-center font-weight-bold text-uppercase">output</h1>
								<hr>

								<!-- output hasil enkripsi dan deskripsi -->
                                <div class="my-2">
                                    <?php 
                                    
                                        $output_caesar = ""; //variable penampung output caesar cipher 
										$output_vigenere =""; //variable penampung output vigenere cipher 

										//fungsi enkripsi
										function enkripsi_vigenere($key, $text) {
											$key = strtolower($key); //ubah key ke lowercase
	
											// inisialisasi variable
											$ki = 0;
											$kl = strlen($key);
											$length = strlen($text);
										
											// lakukan perulangan untuk setiap abjad
											for ($i = 0; $i < $length; $i++){
												
												// cek text
												if (ctype_alpha($text[$i])){
	
													// jika text merupakan huruf kapital (semua)
													if (ctype_upper($text[$i])){
														$text[$i] = chr(((ord($key[$ki]) - ord("a") + ord($text[$i]) - ord("A")) % 26) + ord("A"));
													}
												
													// jika text merupakan huruf kecil (semua)
													else{
														$text[$i] = chr(((ord($key[$ki]) - ord("a") + ord($text[$i]) - ord("a")) % 26) + ord("a"));
													}
												
													// update the index of key
													$ki++;
													if ($ki >= $kl) {
														$ki = 0;
													}
												}
											}
										
											// mengembalikan nilai text
											return $text;
										}

										 // membuat fungsi dekripsi
										 function deskripsi_vigenere($key, $text) {
											$key = strtolower($key);
										
											// inisialisasi variable
											$ki = 0;
											$kl = strlen($key);
											$length = strlen($text);
										
											// lakukan perulangan untuk setiap abjad
											for ($i = 0; $i < $length; $i++)
											{
												// jika text merupakan alphabet
												if (ctype_alpha($text[$i]))
												{
													// jika text merupakan huruf kapital (semua)
													if (ctype_upper($text[$i])) {
														$x = (ord($text[$i]) - ord("A")) - (ord($key[$ki]) - ord("a"));
													
														if ($x < 0){
															$x += 26;
														}
													
														$x = $x + ord("A");
													
														$text[$i] = chr($x);
													}
												
													// jika text merupakan huruf kecil (semua)
													else
													{
														$x = (ord($text[$i]) - ord("a")) - (ord($key[$ki]) - ord("a"));
													
														if ($x < 0) {
															$x += 26;
														}
													
														$x = $x + ord("a");
													
														$text[$i] = chr($x);
													}
												
													// update the index of key
													$ki++;
													if ($ki >= $kl) {
														$ki = 0;
													}
												}
											}
										
											// mengembalikan nilai text
											return $text;
										}

                                    	function cipher($char, $key){ //membuat fungsi cipher
                                    		if (ctype_alpha($char)) { //cek alphabet atau tidak
                                    			$nilai = ord(ctype_upper($char) ? 'A' : 'a'); 
                                    			$ch = ord($char); //konvensi ke karakter ASCII
                                    			$mod = fmod($ch + $key - $nilai, 26); //perhitangan modulus
                                    			$hasil = chr($mod + $nilai);  //hasil modulus ditambah dengan nilai dan konversi ke bentuk alphabet
                                    			return $hasil; 
                                    		} else { //mengebalikan nilai inputan jika selain alphabet
                                    			return $char;
                                    		}
                                    	}
                                    
                                        if(isset($_POST['enkripsi'])){ //cek enkripsi
                                            $text_input = $_POST['input_text']; //deklarasi text inputan
                                    		$kunci_caesar = $_POST['input_key_caesar']; //deklarasi kunci caesar cipher
											$kunci_vigenere = $_POST['input_key_vigenere']; //deklarasi kunci vigenere cipher
                                        
                                    		$chars = str_split($text_input); //variabel untuk menampung data yang diinput
                                        
                                    		foreach ($chars as $char) { //perulangan untuk menampilkan data array
                                    			$output_caesar .= cipher($char, $kunci_caesar); //menjalankan fungsi cipher
                                    		}
                                        
                                    		$chars_output = str_split($output_caesar); //variabel untuk menampung data yang dienkripsi untuk dideskripsikan
                                    		$deskripsi = ""; //variable penampung deskripsi
                                        
                                    		foreach ($chars_output as $char) { //perulangan untuk menampilkan data array
                                    			$deskripsi .= cipher($char, 26 - $kunci_caesar); //mengembalikan fungsi cipher
                                    		}

											$output_vigenere = enkripsi_vigenere($kunci_vigenere, $output_caesar);

                                    		//pemanggilan variable untuk ditampilkan di output
                                            echo "	
                                    				<p> Text yang dienkripsi : <strong>"."$text_input"."</strong></p>
                                    				<p> Kunci Caesar : <strong>"."$kunci_caesar"."</strong></p>
                                    				<p> Kunci Vigenere : <strong>"."$kunci_vigenere"."</strong></p>
                                    				<p> Hasil : </p>
                                            ";
										?>

										<h1 class="h6 text-gray-900 mb-4">Caesar Cipher: </h1> 
											<form class="user" method="POST"> 
							    			    <div class="form-group">
											        <input id="username" type="text" name="input_text" class="form-control form-control-user text-center font-weight-bold text-uppercase" value="<?php echo $output_caesar;?>" readonly>
							    			    </div>
							    			    <hr>
						        			</form>

							  			<h1 class="h6 text-gray-900 mb-4 fw-blod">Vigenere Cipher: </h1> 
											<form class="user" method="POST"> 
							    			    <div class="form-group">
											        <input id="username" type="text" name="input_text" class="form-control form-control-user text-center font-weight-bold text-uppercase" value="<?php echo $output_vigenere;?>" readonly>
							    			    </div>
							    			    <hr>
						        			</form>

								<?php

                                        }

										if(isset($_POST['deskripsi'])){ //cek deskripsi
                                            $text_input = $_POST['input_text']; //deklarasi text inputan
                                    		$kunci_caesar = $_POST['input_key_caesar']; //deklarasi kunci caesar cipher
											$kunci_vigenere = $_POST['input_key_vigenere']; //deklarasi kunci vigenere cipher

											$output_vigenere = deskripsi_vigenere($kunci_vigenere, $text_input);
                                        
                                    		$chars = str_split($output_vigenere); //variabel untuk menampung data yang diinput
                                        
                                    		foreach ($chars as $char) { //perulangan untuk menampilkan data array
                                    			$output_caesar .= cipher($char, 26 - $kunci_caesar); //mengembalikan fungsi cipher
                                    		}
                                        
                                    		$chars_output = str_split($output_caesar); //variabel untuk menampung data yang dienkripsi untuk dienkripsikan
                                    		$enkripsi = ""; //variable penampung enkripsi
                                        
                                    		foreach ($chars_output as $char) { //perulangan untuk menampilkan data array
                                    			$enkripsi .= cipher($char, $kunci_caesar); //menjalankan fungsi cipher
                                    		}
                                        
                                    		//pemanggilan variable untuk ditampilkan di output
                                            echo "	
                                    				<p> Text yang dideskripsi : <strong>"."$text_input"."</strong></p>
                                    				<p> Kunci Caesar : <strong>"."$kunci_caesar"."</strong></p>
                                    				<p> Kunci Vigenere : <strong>"."$kunci_vigenere"."</strong></p>
                                    				<p> Hasil : </p>
                                            ";
											?>
	
											<h1 class="h6 text-gray-900 mb-4 fw-blod">Vigenere Cipher: </h1> 
											  <form class="user" method="POST"> 
												  <div class="form-group">
													  <input id="username" type="text" name="input_text" class="form-control form-control-user text-center font-weight-bold text-uppercase" value="<?php echo $output_vigenere;?>" readonly>
												  </div>
												  <hr>
											  </form>
	
											<h1 class="h6 text-gray-900 mb-4">Caesar Cipher: </h1> 
												<form class="user" method="POST"> 
													<div class="form-group">
														<input id="username" type="text" name="input_text" class="form-control form-control-user text-center font-weight-bold text-uppercase" value="<?php echo $output_caesar;?>" readonly>
													</div>
													<hr>
												</form>
									<?php
                                        
                                        }
                                    ?>
                                </div> 

							  	


            			  </div>
      				    </div>
         			  </div>
        			</div>
             </div>
            </div>
  
		</div>
	</div>
</div>  