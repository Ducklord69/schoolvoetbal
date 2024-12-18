using SchoolVoetbalAPI.Models;
using Microsoft.EntityFrameworkCore;

namespace SchoolVoetbalAPI.Data
{
    public class ApplicationDbContext : DbContext
    {
        public ApplicationDbContext(DbContextOptions<ApplicationDbContext> options)
            : base(options) { }

        public DbSet<User> Users { get; set; }
    }
}
