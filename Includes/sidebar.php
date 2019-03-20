<?php
		
	 
	// include_once('http://45.56.93.78/exactarget/Includes/sessionVerificationMailer.php'); 
	$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	verify($monUrl);

?>

<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li class="navigation-header"><span>Menu</span> <i class="icon-menu" title="Main pages"></i></li>
								
								<?php 
								
								
								/***************************************  DOMAINS MANAGER  ************************************************/
								
								if($_SESSION['type_Employer']=="Domains Manager")
								{
								?>
									
									<li>
									    <a href="#"><i class="icon-search4"></i><span>Domain</span></a>
										<ul>
											<li>
												<a href="http://localhost/pksol/exactarget/Domain/IU_Domain.php">
													Add Domain
												</a>
												
											</li>
											
											<li>
												<a href="http://localhost/pksol/exactarget/Domain/ShowDomains.php">
													Show Domains
												</a>
											</li>
										</ul>
									</li>
								
									<li>
										<a href="#"><i class="icon-search4"></i> <span>Servers-IPS-Domains</span>  </a>
										<ul>
											<li>
												<a href="http://localhost/pksol/exactarget/Send/getServerDomains.php">
													Filter
												</a>
											</li>
										</ul>
									</li>
									
									<li><a href="http://localhost/pksol/exactarget/NameCheap/ConfigureDns.php">NameCheap</a></li>
								
								
								<?php
								}
								
								
								/***************************************  OFFER MANAGER  ************************************************/
								
								
								if($_SESSION['type_Employer']=="Offer Manager")
								{
								?>
									
									<li>
										<a href="#"><i class="icon-collaboration"></i> <span>Sponsor</span></a>
										<ul>
											<li>
												<a href="http://localhost/pksol/exactarget/Sponsor/IU_Sponsor.php">
													Add Sponsor
												</a>
											</li>
											<li>
												<a href="http://localhost/pksol/exactarget/Sponsor/ShowSponsors.php">
													Show Sponsors
												</a>
											</li>
										</ul>
									</li>
									
									
									<li>
										<a href="#"><i class="icon-newspaper"></i> <span>Offer</span></a>
										<ul>
											<li><a href="http://localhost/pksol/exactarget/Offer/IU_Offer.php">Add Offer</a></li>
											<li><a href="http://localhost/pksol/exactarget/Offer/ShowOffers.php">Show Offers</a></li>
										</ul>
									</li>
									
									
									<li>
										<a href="#"><i class="icon-camera"></i> <span>Image</span> </a>
										<ul>
											<li>
												<a href="http://localhost/pksol/exactarget/Offer/upload_image.php">
													Upload Image
												</a>
											</li>
										</ul>
									</li>
									
								
								<?php
								}
								
								/***************************************  MAILER  ************************************************/
								
								elseif($_SESSION['type_Employer']=="Mailer")
								{
								?>
									<li>
										<a href="http://localhost/pksol/exactarget/Sponsor/ShowSponsors.php" target="_blank"><i class="icon-collaboration"></i> <span>Show Sponsors</span></a>

									</li>
								
											<?php
											
											 ?><li><a href="http://localhost/pksol/exactarget/Send/emailTestGlobal.php" target="_blank"><i class="icon-target2"></i><span>Email Test Global</span></a></li><?php
											
											?>
								
								
									<li>
										<a href="#"><i class="icon-mail5"></i> <span>Send</span></a>
										<ul>
											<li>
												<a href="http://localhost/pksol/exactarget/Send/prepareSend.php" target="_blank">
													Prepare Send
												</a>
											</li>
											<li>
												<a href="http://localhost/pksol/exactarget/Send/ShowSends.php" target="_blank">
													Show Sends
												</a>
											</li>
											
											<li>
												<a href="http://localhost/pksol/exactarget/Send/ShowSendsLists.php" target="_blank">
													Show Sends History
												</a>
											</li>
											
										</ul>
									</li>
								
								
									<li>
										<a href="#"><i class="icon-map4"></i> <span>PMTA</span></a>
										<ul>
											<li>
												<a href="http://localhost/pksol/exactarget/Send/PMTA.php" target="_blank">
													Show PMTAS
												</a>
											</li>
											<li>
												<a href="http://localhost/pksol/exactarget/PMTA/editConfig.php" target="_blank">
													Edit Config  
												</a>
											</li>
											<li>
												<a href="http://localhost/pksol/exactarget/VMTA/U_VMTA.php" target="_blank">
													Edit VMTA  
												</a>
											</li>
										</ul>
									</li>
								

									<li>
										<a href="#"><i class="icon-spinner3 spinner"></i> <span>Negative </span></a>
										<ul>
											<li>
												<a href="http://localhost/pksol/exactarget/Negative/uploadNegative.php" target="_blank">
													Add Negative
												</a>
											</li>
											
											<li>
												<a href="http://localhost/pksol/exactarget/Negative/ShowNegatives.php" target="_blank">
													Show Negatives
												</a>
											</li>
											<li>
												<a href="http://localhost/pksol/exactarget/Send/imap.php" target="_blank">
													Build Negative
												</a>
											</li>
											
									
										</ul>
									</li>
								

									<li>
										 <a href="http://localhost/pksol/exactarget/Send/ShowLogs.php" target="_blank"><i class="icon-warning"></i>
												<span>Show Logs</span>
										 </a>
								    </li>

								
								

									<li>
										<a href="http://localhost/pksol/exactarget/Offer/upload_image.php" target="_blank"><i class="icon-camera"></i>
												<span>Upload Image</span>
										</a>
							       </li>
								
								
								
									<li>
										<a href="http://localhost/pksol/exactarget/List/IU_WarmUP.php" target="_blank"><i class="icon-add-to-list"></i>
											    <span>Warm UP List</span>
										</a>
									</li>
								
									
									

									<li>
										<a href="http://localhost/pksol/exactarget/Send/imap.php" target="_blank"><i class="icon-mailbox"></i>
												<span>IMAP</span>
										</a>
									</li>
								
								
								
								
									<li>
										<a href="http://localhost/pksol/exactarget/Send/reporting.php" target="_blank"><i class="icon-drawer-out"></i>
												<span>Reporting tool</span>
										</a>
									</li>
								
								
								
									<li>
										<a href="http://localhost/pksol/exactarget/Send/spfChecker.php" target="_blank"><i class="icon-file-check2"></i>
												<span>SPF CHECKER</span>
										</a>
									</li>
								
								
								
									<li>
										<a href="http://localhost/pksol/exactarget/Send/StatsOffer.php" target="_blank"><i class="icon-stats-growth"></i>
												<span>Stats Offer</span>
										</a>
									</li>
									
									
									
									<li>
										<a href="#"><i class="icon-search4"></i> <span>Servers-IPS-Domains</span>  </a>
										<ul>
											<li>
												<a href="http://localhost/pksol/exactarget/Send/getServerDomains.php" target="_blank">
													Filter
												</a>
											</li>
										</ul>
									</li>

							
							
									<li>
										<a href="#"><i class="icon-ticket"></i> <span>Tickets</span></a>
										<ul>
											<li>
												<a href="http://localhost/pksol/exactarget/ticket/list_ticket.php">
													My Tickets
												</a>
											</li>
											
											<li>
												<a href="http://localhost/pksol/exactarget/ticket/ui_ticket.php">
													Open new ticket
												</a>
											</li>
										</ul>
									</li>
									
									
								<?php
								}
								
								
								/***************************************  ADMIN  ************************************************/
								
								elseif($_SESSION['type_Employer']=="IT")
								{
								?>
								
								
									<li>
										<a href="#"><i class="icon-collaboration"></i> <span>Sponsor</span></a>
										<ul>
											<li>
												<a href="http://localhost/pksol/exactarget/Sponsor/IU_Sponsor.php">
													Add Sponsor
												</a>
											</li>
											<li>
												<a href="http://localhost/pksol/exactarget/Sponsor/ShowSponsors.php">
													Show Sponsors
												</a>
											</li>
										</ul>
									</li>
									
                                    <li>
										<a href="#"><i class="icon-person"></i> <span>Employers</span></a>
										<ul>
											<li>
											   <a href="#">Employers</a>
												<ul>
													<li>
														<a href="http://localhost/pksol/exactarget/Employer/IU_Employer.php">
															Add Employer
														</a>
													</li>
													<li>
														<a href="http://localhost/pksol/exactarget/Employer/ShowEmployers.php">Show Employers
														</a>
													</li>
												</ul>
											</li>
											<li>
												<a href="#"><span>Types Employers</a>
												<ul>
													<li>
														<a href="http://localhost/pksol/exactarget/Type_Employer/IU_Type_Employer.php">
															Add Type
														</a>
													</li>
													<li>
														<a href="http://localhost/pksol/exactarget/Type_Employer/ShowTypes.php">
															Show Types
														</a>
													</li>
												</ul>
								            </li>
										</ul>
									</li>
									
		
									<li>
										<a href="#"><i class="icon-bubble-notification"></i> <span>Notifications</span></a>
										<ul>
											<li>
												<a href="http://localhost/pksol/exactarget/Notification/IU_Notification.php">
													Add Notification
												</a>
											</li>
											<li>
												<a href="http://localhost/pksol/exactarget/Notification/ShowNotifications.php">
													Show Notifications
												</a>
											</li>
										</ul>
									</li>
									
																
									<li>
										<a href="#"><i class="icon-mention"></i> <span>ISPS</span></a>
										<ul>
											<li><a href="http://localhost/pksol/exactarget/ISP/IU_ISP.php">Add ISP</a></li>
											<li><a href="http://localhost/pksol/exactarget/ISP/ShowISPS.php">Show ISPS</a></li>
										</ul>
									</li>
								
									<li>
										<a href="#"><i class="icon-IE"></i> <span>Domain</span></a>
										<ul>
										
										<li>
											<a href="#"><span>Domain Provider</span></a>
											<ul>
												<li><a href="http://localhost/pksol/exactarget/DomainProvider/IU_DomainProvider.php">Add Domain Provider</a></li>
												<li><a href="http://localhost/pksol/exactarget/DomainProvider/ShowDomainProviders.php">Show Domain Provider</a></li>
											</ul>
										</li>
									
										  <li>
											 <a href="#"><span>Domain</span></a>
											 <ul>
												<li><a href="http://localhost/pksol/exactarget/Domain/IU_Domain.php">Add Domain</a></li>
												<li><a href="http://localhost/pksol/exactarget/Domain/ShowDomains.php">Show Domains</a></li>
												<li><a href="http://localhost/pksol/exactarget/Domain/AddMultiDomains.php">Add Multi Domains</a></li>
											 </ul>
											 
											 <li><a href="http://localhost/pksol/exactarget/NameCheap/ConfigureDns.php">NameCheap</a></li>
											 
										  </li>
										</ul>
									</li>
								
								
									<li>
										<a href="#"><i class="icon-server"></i> <span>Server</span></a>
										<ul>
										
											<li>
												<a href="#"><span>Server Provider</span></a>
												<ul>
													<li><a href="http://localhost/pksol/exactarget/ServerProvider/IU_ServerProvider.php">Add Server Provider</a></li>
													<li><a href="http://localhost/pksol/exactarget/ServerProvider/ShowServerProviders.php">Show Server Provider</a></li>
												</ul>
											</li>
										   
										   
										   <li>
												<a href="#"><span>OS</span></a>
												<ul>
													<li><a href="http://localhost/pksol/exactarget/OS/IU_OS.php">Add OS</a></li>
													<li><a href="http://localhost/pksol/exactarget/OS/ShowOS.php">Show OS</a></li>
												</ul>
										   </li>
									
											<li>
											  <a href="#"><span>Server</a>
											  <ul>
											   <li><a href="http://localhost/pksol/exactarget/Server/IU_Server.php">Add Server</a></li>
											   <li><a href="http://localhost/pksol/exactarget/Server/ShowServers.php">Show Servers</a></li>
											  </ul>
											</li>
											
										</ul>
									</li>
									
									<li>
										<a href="#"><i class="icon-flag3"></i> <span>Country</span></a>
										<ul>
											<li><a href="http://localhost/pksol/exactarget/Country/IU_Country.php">Add Country</a></li>
											<li><a href="http://localhost/pksol/exactarget/Country/ShowCountrys.php">Show Countrys</a></li>
										</ul>
									</li>
								
								
								
									<li>
										<a href="#"><i class="icon-move-vertical"></i> <span>Vertical</span></a>
										<ul>
											<li><a href="http://localhost/pksol/exactarget/Vertical/IU_Vertical.php">Add Vertical</a></li>
											<li><a href="http://localhost/pksol/exactarget/Vertical/ShowVerticals.php">Show Verticals</a></li>
										</ul>
									</li>
								
								
									<li>
										<a href="#"><i class="icon-newspaper"></i> <span>Offer</span></a>
										<ul>
											<li><a href="http://localhost/pksol/exactarget/Offer/IU_Offer.php">Add Offer</a></li>
											<li><a href="http://localhost/pksol/exactarget/Offer/ShowOffers.php">Show Offers</a></li>
											<li><a href="http://localhost/pksol/exactarget/Offer/DeleteMultiOffers.php">Delete Multi Offers</a></li>
										</ul>
									</li>
								
								
									<li>
										<a href="#"><i class="icon-list-numbered"></i> <span>List</span></a>
										<ul>
										
										<li>
												<a href="http://localhost/pksol/exactarget/List/wrapper.php"><i class="icon-split"></i> <span>Wrapper</span></a>
												
										</li>
										
										
										<li>
											<a href="#"><span>Type List</span></a>
											<ul>
												<li><a href="http://localhost/pksol/exactarget/TypeList/IU_TypeList.php">Add Type</a></li>
												<li><a href="http://localhost/pksol/exactarget/TypeList/ShowTypeLists.php">Show Types</a></li>
											</ul>
										</li>
									
											<li>
											  <a href="#"><span>List</span></a>
											  <ul>
												<li><a href="http://localhost/pksol/exactarget/List/IU_List.php">Add List</a></li>
												<li><a href="http://localhost/pksol/exactarget/List/ShowLists.php">Show Lists</a></li>
											  </ul>
											</li>
											
											<li><a href="http://localhost/pksol/exactarget/GetEmail/GetEmail.php">Get Email By ID</a></li>
											
										</ul>
									</li>
								
									<li>
											<a href="http://localhost/pksol/exactarget/Send/DeleteHardBounce.php"><i class="icon-newspaper"></i><span>Delete Emails</span></a>
									</li>
									
									<li>
										<a href="#"><i class="icon-wrench"></i> <span>Tools</span></a>
										<ul>
										   <li>
												<a href="http://localhost/pksol/exactarget/tools/uploader.php">
													FTP Tool
												</a>
											</li>
										</ul>
									</li>
									
									<li>
										<a href="#"><i class="icon-ticket"></i> <span>Tickets</span></a>
										<ul>
											<li>
												<a href="http://localhost/pksol/exactarget/ticket/list_ticket.php">
													My Tickets
												</a>
											</li>
											
											<li>
												<a href="http://localhost/pksol/exactarget/ticket/ui_ticket.php">
													Open new ticket
												</a>
											</li>
										</ul>
									</li>
								
								
								<?php	
								}
								?>
							
							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
