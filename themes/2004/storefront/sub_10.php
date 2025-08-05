
					<tr>
						<td nowrap class="arithmetic">Package price</td>
						<td nowrap align="right" class="arithmetic">$59.95</td>
					</tr>
					<?php $fullprice = 59.95 ?>
					<?php $finalprice = 59.95 ?>
					<?php $discount = 0 ?>
					<?php if (strpos($s, ',5')) echo 
					'<tr>
						<td nowrap class="arithmetic">ATI HL2 coupon</td>
						<td nowrap align="right" class="arithmetic">-$49.95</td>
					</tr>'
					?>
					<?php if (strpos($s, ',5')) $discount = 49.95 ?>
					<?php $finalprice = $fullprice - $discount ?>
					<?php if (strlen($finalprice) == 2) $finalprice .= '.00' ?>
					<tr>
						<td
							nowrap class="arithmetic"
							colspan="2"
							style="border-top: 2px Solid #293021;"
						>FINAL PRICE:<span class="total"> $<?php echo $finalprice ?></span> +TAX</td>
					</tr>
					<tr
						onMouseOver="this.style.color='#BDBE52'"
						onMouseOut="this.style.color='white'"
						onClick="window.open('steam://purchase/10', '_top');"
						style="cursor: hand;"
					>
						<td nowrap class="purchase5"><?php echo $purchased10 ?></td>
						<td nowrap class="purchase6">&nbsp;</td>
					</tr>