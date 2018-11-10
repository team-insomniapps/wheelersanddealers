// On page load it'll scroll the messages window to the bottom so the newest messages can be seen.
			function scrollToBottom(msgIDname) {
				var objDiv = document.getElementById(msgIDname);
				objDiv.scrollTop = objDiv.scrollHeight;
			}
			
