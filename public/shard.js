/**
 * Shard
 * Shards a given user to a provided prefix
 * @param {String} prefix The Prefix for the shard
 * @param {Integer} size  The Size of the shard
 */
 function Shard(prefix, size){
	this.size = size;
	this.prefix = prefix;
 }

/**
 * Get the shard
 * @param  {Integer} id The ID to find the shard
 * @return {String}    The Shard
 */
 Shard.prototype.get = function(id) {
	var shard = Math.floor(id / this.size);
	return this.prefix + shard;
 };

//Export the class as a module
module.exports = Shard;