function getxhr()
{
	return new XMLHttpRequest();
}

// Actions: reserve, remove
function reserve_wish(action, user_name, wish_name, wish_id)
{
	var req = getxhr();
	req.onreadystatechange=function()
	{
		if(req.readyState==4 && req.status==200)
		{
            if(action === 'remove')
            {
                $("#list_"+wish_id).html(wish_name+"<span class='tabulation' /><input type='checkbox' onclick=\"reserve_wish('reserve','"+user_name+"','"+wish_name+"',"+wish_id+");\"/>Réservez le !");
            }
            else if(action === 'reserve')
            {
                $("#list_"+wish_id).html(wish_name+"<span class='tabulation' /><input id='checkbox_"+wish_id+"' type='checkbox' checked='checked' onclick=\"reserve_wish('remove','"+user_name+"','"+wish_name+"',"+wish_id+");\" />Reservé par vous");
            }
		}
	}
	req.open("GET", "reserve_wish.php?action="+action+"&wish_id="+wish_id, true);
	req.send(null);
}