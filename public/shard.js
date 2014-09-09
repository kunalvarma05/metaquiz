/**
 * Shard
 * Shards a given user to a provided prefix
 *
 * @param  {Integer} user_id
 * @param  {String} prefix
 * @param  {Integer} shard_size
 * @return {String}
 */
module.exports = {

	get : function(user_id, prefix, shard_size) {
		var shard = Math.floor(user_id / shard_size);
		return prefix + shard;
	}
};
