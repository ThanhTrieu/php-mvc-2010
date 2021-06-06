function deleteBrand(id) {
	if(confirm('Are you sure you want to delete ???')){
		$.ajax({
			url: "?c=brand&m=delete",
			data: { id: id},
			method: "post",
			beforeSend: function(){
				$('#del_'+id).text('Loading...');
			},
			success: function(result){
				// result : ket qua tu phia controller xu ly tra ve
				$('#del_'+id).text('Delete');
				if(result === 'SUCCESS'){
					alert('success');
					// an cai dong minh xoa
					$('#brand_'+id).hide();
				} else {
					alert('error, please try again');
				}
			}
		});
	}
}

function searchBrand() {
	let nameBrand = $('#nameBrand').val().trim();
	if(nameBrand !== '') {
		window.location.href = "?c=brand&m=index&s="+nameBrand;
	}
}

