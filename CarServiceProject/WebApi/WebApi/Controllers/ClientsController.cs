using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Data.Entity.Infrastructure;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using System.Web.Http.Description;
using WebApi.Models;

namespace WebApi.Controllers
{
    public class ClientsController : ApiController
    {
        private CarServiceDB db = new CarServiceDB();

        // GET: api/Clients
        public IQueryable<Client> GetClients()
        {
            return db.Clients;
        }

        // GET: api/Clients/5
        [ResponseType(typeof(Client))]
        public IHttpActionResult GetClient(int id)
        {
            Client client = db.Clients.Find(id);
            if (client == null)
            {
                return NotFound();
            }

            return Ok(client);
        }

        // GET: api/Problems?hp={hp}
        [ResponseType(typeof(List<Client>))]
        public IQueryable<Client> GetProblem(string Lname)
        {
            if (Lname == null)
            {
                return db.Clients;
            }
            var clients = db.Clients;
            List<Client> clts = new List<Client>();
            foreach (var c in clients)
            {
                if (c.Lname.ToLower().Contains(Lname.ToLower()))
                {
                    clts.Add(c);
                }
            }

            return clts.AsQueryable<Client>();
        }

        // PUT: api/Clients/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutClient(int id, Client client)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != client.ClientId)
            {
                return BadRequest();
            }

            db.Entry(client).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!ClientExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return StatusCode(HttpStatusCode.NoContent);
        }

        // POST: api/Clients
        [ResponseType(typeof(Client))]
        public IHttpActionResult PostClient(Client client)
        {
                if (!ModelState.IsValid)
                {
                    return BadRequest(ModelState);
                }

            if (CheckClientFields(client))
            {
                db.Clients.Add(client);
                db.SaveChanges();

                return CreatedAtRoute("DefaultApi", new { id = client.ClientId }, client);
            }
            else
            {
                return BadRequest();
            }
            

        }

        private bool CheckClientFields(Client client)
        {
            if (client.Fname == null || client.Fname.Length>50)
            {
                return false;
            }
            else if (client.Lname == null || client.Lname.Length > 50)
            {
                return false;
            }
            else if (client.email==null||client.email.Length>70)
            {
                return false;
            }else if (client.CarId<0)
            {
                return false;
            }
            return true;
        }

        // DELETE: api/Clients/5
        [ResponseType(typeof(Client))]
        public IHttpActionResult DeleteClient(int id)
        {
            Client client = db.Clients.Find(id);
            if (client == null)
            {
                return NotFound();
            }

            db.Clients.Remove(client);
            db.SaveChanges();

            return Ok(client);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool ClientExists(int id)
        {
            return db.Clients.Count(e => e.ClientId == id) > 0;
        }
    }
}